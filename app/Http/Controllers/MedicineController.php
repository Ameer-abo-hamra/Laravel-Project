<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Traits\GeneralTrait;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Validator;

class MedicineController extends Controller
{
    use GeneralTrait, ResponseTrait;
    public function search(Request $request)
    {

        $med = Medicine::where("category", $request->value)->orWhere("s_name", $request->value)->get();
        if (count($med) == 0) {
            return $this->returnError("this medicine does not exist");
        }
        return $this->returnData("this is your product", "medicine", $med);
    }

    public function store(Request $request)
    {
        $validator = validator::make($request->all(), [

            "s_name" => "unique:medicines|required",
            "t_name" => "unique:medications| required",
            "category" => "required",
            "company" => "required",
            "amount" => "required | numeric |integer",
            "end_date" => "required|date",
            "price" => "required|numeric|min:1"

        ]);

        if ($validator->fails()) {

            return $this->returnError($validator->errors()->first());
        }


        $this->addMedicine($request->all());

        return $this->returnSuccess("your data is saved :)");

    }
}
