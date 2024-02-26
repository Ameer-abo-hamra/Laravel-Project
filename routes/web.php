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
    ]);

});

Route::get("/", function () {
    return view("AdminLogin");
})->name("llogin");

Route::post('login', [AdminController::class, "login"])->name("login");

Route::group(['middleware' => "checkSession"], function () {

    Route::get("home-page", function () {
        return view("HomePage");
    })->name("home.page");


    Route::get('logout', [AdminController::class, "logout"])->name("logout");
    Route::get("add-medicine", function () {
        return view("AddMedicine");
    });
    Route::post('add-medicine', [MedicineController::class, "store"])->name("add.medicine");

    Route::post("search", [MedicineController::class, "search"])->name("search");

    Route::get("delete-medicine/{id}", [MedicineController::class, "delete"])->name('delete');

    Route::get("all-medicine", [MedicineController::class, "getmedicine"])->name("all");

    Route::get('one-medicine/{id}', [MedicineController::class, "onemedicine"])->name("one.medicine");

    Route::post("update-medicine" , [MedicineController::class , "updateMedicine"])->name("update.medicine");

    Route::get("show-details/{med_id}", [MedicineController::class, "showDetails"]);

    Route::get("getorders", [OrderController::class, "getOrders"])->name("get.orders");

    Route::get("order-datails/{order_id}", [OrderController::class, 'showOrderDetails']);

    Route::post("changestate", [AdminController::class, 'update'])->name("update.order");

});






