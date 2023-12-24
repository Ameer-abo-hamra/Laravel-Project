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

            "username" => "required",
            "password" => "required | min:8 | max:15"

        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);

        }
        $cre = $request->only("username", "password");
        if (Auth::guard('web')->attempt($cre)) {

            $admin = Auth::guard('web')->user();

            return $this->returnSuccess("you are logged-in successfully :)");
        }

        return $this->returnError("your data is invalid");


    }


    public function logout()
    {

        Auth::guard("web")->logout();
        return $this->returnSuccess("you are logged-out successfully :(");
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
