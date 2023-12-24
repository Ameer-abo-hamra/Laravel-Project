<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\OrderMid;
use App\Traits\ResponseTrait;
use Exception;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    use ResponseTrait;

    public function addOrder(Request $request)
    {
        $amounts = array_filter($request->quan);
        $ids = $request->medicine_Ids;
        $price = 0;
        for ($i = 0; $i < count($amounts); $i++) {
            $currnetPrice = Medicine::find($ids[$i])->price;
            $price += $currnetPrice * $amounts[$i];
        }


        Order::create([

            "pharmacist_id" => $request->pharmacist_id,
            "price" => $price
        ]);
        $order_id = Order::latest()->value('id');
        $order = Order::find($order_id);
        foreach ($request->medicine_Ids as $key => $medicineId) {
            $medicine = Medicine::find($medicineId);
            $order->medicines()->attach($medicineId, [
                'amount' => $amounts[$key],
                'price' => $medicine->price,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        return $this->returnSuccess("your order is saved");
        // return $order;
    }
    public function getOrders()
    {

        $orders = Order::get();
        return $this->returnData("done", "orders", $orders->makeHidden("isStateModified"));
    }



}
