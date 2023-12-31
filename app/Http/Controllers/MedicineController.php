<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Traits\GeneralTrait;
use App\Traits\ResponseTrait;
use Faker\Provider\Medical;
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
            "t_name" => "unique:medicines| required",
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

    public function showDetails($id)
    {

        $medicine = Medicine::find($id);

        if ($medicine) {
            return $this->returnData("", "medicine details : ", $medicine);
        }
    }


    public function getmedicine()
    {

        $medicinesGroupedByCategory = Medicine::get()->groupBy("category");

        if (count($medicinesGroupedByCategory) != 0) {
            return $this->returnData("done", "categories", $medicinesGroupedByCategory->makeVisible("id"));
        }
        return $this->returnError("there are no categories until now");
    }
}
