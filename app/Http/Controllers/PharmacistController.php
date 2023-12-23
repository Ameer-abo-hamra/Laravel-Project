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

            "phone" => "unique:pharmacists,phone||required||min:10||max:10",
            "password" => "required|min:6|max:15",
        ]);
        if ($validator->fails()) {
            return $this->returnError( $validator->errors()->first(),400);
        }

        $user = Pharmacist::create([
            "phone" => $request->phone,
            "password" => Hash::make($request->password),
        ]);

        $user->assignRole("user");
        return $this->returnSuccess("your data is saved successfully");
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => "required||min:10||max:10",
            "password" => "required||min:6||max:15",
        ]);

        if ($validator->fails()) {
            return $this->returnError( $validator->errors()->first(),400);
        }

        $credentials = $request->only("phone", "password");
        $token = Auth::guard("api")->attempt($credentials);
        if ($token) {
            $pharmacist = Auth::guard("api")->user();
            Auth::guard('api')->setToken($token)->authenticate();
            $pharmacist->api_token = $token;
            return $this->returnData("you are logged-in successfully", "pharmacist_information", $pharmacist->makeVisible("id"));
        }

        return $this->returnError('your data is not valid ');
    }



    public function logout(Request $request)
    {

      $token= $request->bearerToken();
        JWTAuth::setToken($token)->invalidate();
        return $this->returnSuccess('you are logged-out successfully ');
    }


    public function getmedicine()
    {

        $medicinesGroupedByCategory = Medicine::get()->groupBy("category");

        if (count($medicinesGroupedByCategory) != 0) {
            return $this->returnData("done", "categories", $medicinesGroupedByCategory->makeVisible("id"));
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


    public function showdetails($id)
    {
        $item = Medicine::find($id);
        return $this->returnData("datails", "more informations", $item);

    }



    public function getOrders($id)
    {
        $orders = Order::where("pharmacist_id", $id)->get();
        return $this->returnData('done', "orders", $orders->makeHidden(["isStateModified" , "pharmacist_id"]));
    }


}
