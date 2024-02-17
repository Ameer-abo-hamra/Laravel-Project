<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Traits\GeneralTrait;
use App\Traits\ResponseTrait;
use Faker\Provider\Medical;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Redirect;

class MedicineController extends Controller
{
    use GeneralTrait, ResponseTrait;
    protected $search = "";
    public function search(Request $request)
    {
        $this->search = $request->value;
        $med = Medicine::where("category", "like", "%" . $request->value . "%")->orWhere("s_name", "like", "%" . $request->value . "%")->get();
        // return view("searchPage", compact("med"));
        if (count($med) != 0) {
            return $this->returnData('done', "medicines", $med);
        }
        return $this->returnError("there are no medicine matched with your saerch", );
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
        return view("allMedicines", compact("medicinesGroupedByCategory"));
        ;
    }

    public function delete($id)
    {
        Medicine::find($id)->delete();
        // return Redirect::route('your-route')->with($this->search);
    }
}
