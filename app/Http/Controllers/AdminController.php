<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Order;
use App\Traits\GeneralTrait;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Double;
use Spatie\Permission\Traits\HasRoles;
use Validator;
use App\Models\Medicine;
use DB;

class AdminController extends Controller
{
    use GeneralTrait;
    use ResponseTrait;

    // im use github
    // also me using github
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



    public function sub(Request $request)
    {


        // return count($request->quan);
        $medicines = $request->medicine_Ids;
        $quan = $request->quan;


        for ($i = 0; $i < count($medicines); $i++) {
            $med = Medicine::find($medicines[$i]);
            //   return   gettype($quan[$i]);
            // Order::create([

            //     "s_name" => $med->s_name,
            //     "amount" => $quan[$i],
            //     "price" => $med->price * $quan[$i],
            //     "pharmacist_id" => "1",
            //     "medicine_id"=>intval($medicines[$i])
            // ]);
                $order = new Order();

                $order->pharmacist_id = 1 ;
                $order->id = 2;
                $order->medicine()->attach();
                // $order->medicines()->attach($medicines, ['quantity' => $quantities]);

        }


    }
}
