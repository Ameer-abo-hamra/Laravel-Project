<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Models\Medicine;
use Faker\Provider\Medical;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PharmacistController;
use App\Models\Order;
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

Route::post("search", [AdminController::class, "search"]);

Route::post('add', [AdminController::class, "store"]);

Route::get("getorders", [AdminController::class, "getOrders"]);

Route::post("changestate", [AdminController::class, 'changeState']);


Route::get("test", function () {


    return view("pushToken");
});


Route::post('test', [AdminController::class, 'showAndChange'])->name('test');

Route::get("gett", [PharmacistController::class, "getPhar"]);



Route::get("or", function () {
    $med = Medicine::get();
    return view("order",compact('med'));
});

Route::post("rtt", [OrderController::Class, 'addOrder'])->name("sub");
