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

Route::group(['middleware' => ["role:admin,web"]], function () {


    Route::get("logout", [AdminController::class, "logout"]);

    Route::post("search", [MedicineController::class, "search"]);

    Route::post('add-medicine', [MedicineController::class, "store"]);

    Route::get("getorders", [OrderController::class, "getOrders"]);

    Route::post("changestate", [AdminController::class, 'update']);


});






