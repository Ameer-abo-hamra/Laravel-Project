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

    Route::post("search", [PharmacistController::class, "search"]);

    Route::get("showdetails/{id}", [PharmacistController::class, "showdetails"]);

    Route::post("order", [OrderController::class, "addOrder"]);

    Route::get("getorders/{pharmacist_id}", [PharmacistController::class, "getOrders"]);

    Route::post("add-to-favorite", [PharmacistController::class, "addToFvorite"]);

});



Route::group(["prefix" => "web"], function () {

    Route::post('add-medicine', [MedicineController::class, "store"]);

    Route::post('login', [AdminController::class, "login"])->name("login");

    Route::group(['middleware' => ["role:admin,web"]], function () {


        Route::get("logout", [AdminController::class, "logout"]);

        Route::post("search", [MedicineController::class, "search"]);

        Route::post('add-medicine', [MedicineController::class, "store"]);

        Route::get("getorders", [OrderController::class, "getOrders"]);

        Route::post("changestate", [AdminController::class, 'update']);


    });
});
