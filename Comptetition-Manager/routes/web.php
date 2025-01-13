<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware("auth")->group(function () {

    Route::view('/', "welcome")->name("home");
    Route::post("/logout", [AuthController::class, "logoutPost"])->name("logout.post");

    Route::resource("user", UserController::class)->only("show","edit","update","destroy");

});



Route::middleware("guest")->group(function () {

    Route::get("/login", [AuthController::class, "login"])->name("login");
    Route::post("/login", [AuthController::class, "loginPost"])->name("login.post");

    Route::get("/register", [AuthController::class, "register"])->name("register");
    Route::post("/register", [AuthController::class, "registerPost"])->name(name: "register.post");
});