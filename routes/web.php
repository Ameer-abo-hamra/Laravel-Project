<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\OrderController;
use App\Models\Medicine;
use Faker\Provider\Medical;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PharmacistController;
use App\Models\Order;
use App\Traits\ResponseTrait;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get("csrf-token", function () {
    return response()->json([
        'csrf_token' => csrf_token(),
        'yousef_session' => Session::getId()
    ]);

});

Route::get("go-login", function () {


    return view("loginAdmin");
});
Route::post('login', [AdminController::class, "login"])->name("login");

Route::group(['middleware' => "checkSession"], function () {


    Route::get("logout", [AdminController::class, "logout"]);

    Route::post('add-medicine', [MedicineController::class, "store"]);

    Route::post("search", [MedicineController::class, "search"]);

    Route::get("all-medicine", [MedicineController::class, "getmedicine"]);

    Route::get("show-details/{med_id}", [MedicineController::class, "showDetails"]);

    Route::get("getorders", [OrderController::class, "getOrders"]);

    Route::get("order-datails/{order_id}", [OrderController::class, 'showOrderDetails']);

    Route::post("changestate", [AdminController::class, 'update']);


});






