<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Traits\GeneralTrait;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Medicine;
use DB;

class AdminController extends Controller
{
    use GeneralTrait;
    use ResponseTrait;


    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [

            "username" => "required || string",
            "password" => "required || min:6 || max:12"

        ]);

        if ($validator->fails()) {
            return $this->returnError($validator->errors()->first());
        }
        $cre = $request->only("username", "password");
        if (Auth::guard('web')->attempt($cre)) {

            $admin =  Auth::guard('web')->user();

            $token = $admin->createToken('web')->plainTextToken;
            return $token;
        }


    }
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            "s_name" => "required||unique:medicines,s_name,except,id||max:10",
            "t_name" => "required||unique:medicines,t_name||max:10",
            "category" => "required||:medicines||max:10",
            "company" => "required||max:10",
            "amount" => "required||max:10",
            "end_date" => "required||max:15",
            "price" => "required||max:10",
        ]);

        if ($validator->fails()) {
            return $this->returnError($validator->errors()->first());
        }

        $this->addMedicine($request->all());


        return $this->returnSuccess('your data is saved');
    }
    public function search(Request $request)
    {

        $med = Medicine::where("category", $request->value)->orWhere("s_name", $request->value)->get();
        if (count($med) == 0) {
            return $this->returnError("this medicine does not exist");
        }
        return $this->returnData("this is your product", "medicine", $med);
    }
    public function getOrders()
    {

        $orders = Order::get();
        return $this->returnData("done", "orders", $orders->makeHidden("isStateModified"));
    }


    public function update(Request $request)
    {
        $order = Order::findOrFail($request->id);

        if ($request->has(["payed", "state"])) {
            $order->update([
                "payed" => $request->payed,
                "state" => $request->state
            ]);

            return $this->returnSuccess("from tow inputs");
        } else if ($request->has(["payed"])) {
            $order->update([
                "payed" => $request->payed,
            ]);

            return $this->returnSuccess("from payed ");
        }
        if ($request->has(["state"])) {
            $order->update([
                "state" => $request->state
            ]);

            return $this->returnSuccess("from state ");
        }

        return $this->returnError("there are a few errors ");
    }




}
