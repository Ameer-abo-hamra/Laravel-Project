<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\OrderMid;
use Exception;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function addOrder(Request $request)
    {

        Order::create([

            "pharmacist_id" => 1
        ]);



        $order_id = Order::latest()->value('id');
        $order = Order::find($order_id);
        return $order->medicines()->attach($request->medicine_Ids);
        // return $order;
    }
}
