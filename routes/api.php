<?php
use App\Http\Controllers\PharmacistController;

use App\Http\Controllers\AdminController;

use App\Http\Controllers\OrderController;
Route::post("register", [PharmacistController::class, "register"]);

Route::post("login", [PharmacistController::class, "login"]);

Route::group(["middleware" => ["role:user,api"]], function () {

    Route::post("logout", [PharmacistController::class, "logout"])->middleware("jwt");

    Route::post("getmedicine", [PharmacistController::class, "getmedicine"]);

    Route::post("search", [PharmacistController::class, "search"]);

    Route::post("showdetails", [PharmacistController::class, "showdetails"]);

    Route::post("order", [OrderController::class, "add"]);

    Route::post("getorders", [PharmacistController::class, "getOrders"]);
});

    Route::get("pharmacist_has_orders" , [PharmacistController::class , "pharmasictHasOrder"]);

    Route::get("pharmacist_name" , [PharmacistController::class , "name"]);

Route::post('add', [AdminController::class, "store"]);

Route::post('update', [AdminController::class, "update"]);

