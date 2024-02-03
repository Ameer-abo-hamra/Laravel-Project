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

        $med = Medicine::where("category", "like", "%" . $request->value . "%")->orWhere("s_name", $request->value)->get();
        return view("searchPage", compact("med"));
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

            return redirect()->back()->with("error", $validator->errors()->first());
        }


        $this->addMedicine($request->all());

        return redirect()->back()->with("success", "your medicine is saved");

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
        // return response()->json([
        //     "data" => $medicinesGroupedByCategory
        // ])
            return view("allMedicines" ,compact("medicinesGroupedByCategory"));
        ;
    }
}
