<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Notifications\CustomNotification;
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
            return $this->returnError($validator->errors()->first());
        }
        $cre = $request->only("username", "password");
        if (Auth::guard('web')->attempt($cre)) {

            // $admin = Auth::guard('web')->user();
            // session(['admin_data' . $admin->id => $admin->toArray()]);
            return $this->returnSuccess("you are logged-in successfully :)");
        }
        return $this->returnError("your data is invalid");


    }


    public function logout()
    {

        $admin = Auth::guard("web")->user();
       Auth("web")->logout();
        // session()->forget('admin' . $admin->id);
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
