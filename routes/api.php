<?php
use App\Http\Controllers\PharmacistController;

use App\Http\Controllers\AdminController;

use App\Http\Controllers\OrderController;

Route::post("register", [PharmacistController::class, "register"])->name("rrr");

Route::post("login", [PharmacistController::class, "login"]);

Route::group(["middleware" => ["role:user,api"]], function () {

    Route::post("logout", [PharmacistController::class, "logout"]);

    Route::get("getmedicine", [PharmacistController::class, "getmedicine"]);

    Route::post("search", [PharmacistController::class, "search"]);

    Route::get("showdetails/{id}", [PharmacistController::class, "showdetails"]);

    Route::post("order", [OrderController::class, "addOrder"]);

    Route::get("getorders/{pharmacist_id}", [PharmacistController::class, "getOrders"]);
});


