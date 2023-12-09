<?php

namespace App\Observers;

use App\Models\Medicine;
use App\Models\Order;
use App\Models\Pharmacist;

class ChangeState
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {

        $isModified = $order->isStateModified;
        if (!$isModified && $order->state == "مستلمة") {

            Order::find($order->id)->update([
                "isStateModified" => 1,

            ]);

            $specificOrder = Order::find($order->id);
            $medicine = Medicine::where("s_name", $order->s_name)->first();
            $new = $medicine->amount - $specificOrder->amount;
            $medicine->update([

                "amount" => $new,
            ]);
        }


    }
    //     public function updated(Order $order): void
// {
//     if ($order->state == "مستلمة") {
//         try {
//             $specificOrder = Order::findOrFail($order->id);
//             $medicine = Medicine::where("s_name", $order->s_name)->firstOrFail();

    //             $new = $medicine->amount - $specificOrder->amount;

    //             // تحديث كمية الدواء مباشرة
//             $medicine->update([
//                 "amount" => $new,
//             ]);

    //             // تسجيل رسالة
//             \Log::info("تم تحديث كمية الدواء بنجاح.");
//         } catch (\Exception $e) {
//             // يمكنك تسجيل رسالة خطأ أو اتخاذ إجراء آخر هنا
//             \Log::error("حدث خطأ: " . $e->getMessage());
//         }
//     }
// }


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
