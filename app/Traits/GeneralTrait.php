<?php
namespace App\Traits;

use App\Models\Medicine;

trait GeneralTrait
{

    public function addMedicine($data)
    {

        Medicine::create([
            "s_name" => $data["s_name"],
            "t_name" => $data["t_name"],
            "category" => $data["category"],
            "company" => $data["company"],
            "amount" => $data["amount"],
            "end_date" => $data["end_date"],
            "price" => $data["price"],

        ]);
    }


    public function validation($data, $rules, $message = null)
    {




    }


}

