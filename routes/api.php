<?php
use App\Http\Controllers\PharmacistController;

use App\Http\Controllers\MedicineController;

use App\Http\Controllers\OrderController;

use App\Http\Controllers\AdminController;

Route::post("register", [PharmacistController::class, "register"])->name("rrr");

Route::post("login", [PharmacistController::class, "login"]);

Route::group(["middleware" => ["role:user,api"]], function () {

    Route::post("logout", [PharmacistController::class, "logout"]);

    Route::get("getmedicine", [PharmacistController::class, "getmedicine"]);

    Route::post("search", [MedicineController::class, "search"]);

    Route::get("showdetails/{id}", [MedicineController::class, "showDetails"]);

    Route::post("order", [OrderController::class, "addOrder"]);

    Route::get("getorders/{pharmacist_id}", [PharmacistController::class, "getOrders"]);

    Route::post("add-to-favorite", [PharmacistController::class, "addToFvorite"]);

});



