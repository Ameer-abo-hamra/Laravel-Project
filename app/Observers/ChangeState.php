<?php

namespace App\Observers;

use App\Models\Medicine;
use App\Models\Order;
use App\Models\Pharmacist;
use DB;

class ChangeState
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {

    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {

        $isModified = $order->isStateModified;
        if (!$isModified && $order->state == "received") {

            Order::find($order->id)->update([
                "isStateModified" => 1,
            ]);

            $specificOrder = Order::find($order->id);
            $orders = DB::table('_order__medicine')->where("order_id", $order->id)->get();
            foreach ($orders as $order) {
                $newAmuont = Medicine::find($order->medicine_id)->amount - $order->amount;
                Medicine::find($order->medicine_id)->update([
                    "amount" => $newAmuont
                ]);

            }
        }


    }



    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}
