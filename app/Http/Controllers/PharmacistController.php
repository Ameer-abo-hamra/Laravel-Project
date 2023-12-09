<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Order;
use App\Models\Pharmacist;
use App\Traits\ResponseTrait;
use Exception;
use GuzzleHttp\ClientTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Facades\JWTAuth;
use Spatie\Permission\Models\Role;

class PharmacistController extends Controller
{
    use ResponseTrait, HasRoles;

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'username' => "unique:pharmacists,username|| required||min:4||max:10",
            "password" => "required||unique:pharmacists,password||min:10||max:10",
        ]);
        if ($validator->fails()) {
            return $this->returnError(400, $validator->errors()->first());
        }

        $user = Pharmacist::create([
            "username" => $request->username,
            "password" => Hash::make($request->password),
        ]);

        $user->assignRole("user");
        return $this->returnSuccess("your data is saved successfully");
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => "required||min:4||max:10",
            "password" => "required||min:10||max:10",
        ]);

        if ($validator->fails()) {
            return $this->returnError(400, $validator->errors()->first());
        }

        $credentials = $request->only("username", "password");
        $token = Auth::guard("api")->attempt($credentials);
        // return response($token);
        if ($token) {
            $pharmacist = Auth::guard("api")->user();
            Auth::guard('api')->setToken($token)->authenticate();
            $pharmacist->api_token = $token;
            return $this->returnData("you are logged-in successfully", "pharmacist_information", $pharmacist);
        }

        return $this->returnError('your data is not valid ');
    }



    public function logout(Request $request)
    {

        Auth::guard("api")->logout();
        JWTAuth::invalidate();

        return $this->returnSuccess('you are logged-out successfully ');
    }


    public function getmedicine(Request $request)
    {

        $medicinesGroupedByCategory = Medicine::select("s_name", "price", "category")->get()->groupBy("category");

        if (count($medicinesGroupedByCategory) != 0) {
            return $this->returnData("done", "categories", $medicinesGroupedByCategory);
        }
        return $this->returnError("there are no categories until now");
    }

    public function search(Request $request)
    {

        $med = Medicine::where("category", $request->value)->orWhere("s_name", $request->value)->get();
        if (count($med) == 0) {
            return $this->returnError("this medicine does not exist");
        }
        return $this->returnData("this is your product", "medicine", $med);
    }

    public function showdetails(Request $request)
    {
        $nameMedicine = $request->input("name");
        $item = Medicine::where("s_name", $nameMedicine)->get();

        return $this->returnData("datails", "more informations", $item);

    }


    public function order(Request $request)
    {

        $validator = Validator::make($request->all(), [

            "s_name" => 'required',
            'amount' => 'required'
        ]);

        if ($validator->fails()) {

            return $this->returnError($validator->errors()->first());
        }

        try {

            $medicine_price = Medicine::where("s_name", "$request->s_name")->select("price")->first();
            Order::create([
                "s_name" => $request->s_name,
                "amount" => $request->amount,
                "price" => $medicine_price->price * $request->amount,
                "pharmacist_id" => $request->pharmacist_id,
                "medicine_id" => $request->medicine_id,
            ]);
        } catch (Exception $e) {

            return $this->returnError($e->getMessage());
        }
        return $this->returnSuccess("your order is saved ");



    }

    public function getOrders(Request $request)
    {

        $pharmacist = Pharmacist::find($request->id);

        return $this->returnData("these are your orders ", "Orders", $pharmacist->orders->makeHidden(["s_name", "isStateModified"]));

    }


    public function pharmasictHasOrder()
    {


        $pharmacist = Pharmacist::whereHas('orders')->get();
        return $this->returnData("done ", "pharmacist", $pharmacist);
    }


    public function name()
    {
        $pha = Pharmacist::whereHas("orders", function ($q) {
            $q->where("username", "Ameer");
        })->get();
        return $this->returnData("", "pha", $pha);
    }


    public function getPhar()
    {

        $phar = Pharmacist::with([
            'orders' => function ($q) {
                $q->where("state", "مستلمة");
            }
        ])->get();
        return $phar;
    }
}
