<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompetitionsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware("auth")->group(function () {

    //User
    Route::view('/', "welcome")->name("home");
    Route::post("/logout", [AuthController::class, "logoutPost"])->name("logout.post");

    Route::resource("user", UserController::class)->only("show","edit","update","destroy");

    //Competitions
    Route::get('/competitions/index',[CompetitionsController::class,'index'])->name('competitions.index');
    Route::get('/competitions/create',[CompetitionsController::class,'create'])->name('competitions.create');
    Route::post('/competitions/store',[CompetitionsController::class,'store'])->name('competitions.store');
    Route::get('/competitions/{comp_name}/{comp_year}/edit',[CompetitionsController::class,'edit'])->name('competitions.edit');
    Route::delete('/competitions/{comp_name}/{comp_year}/delete',[CompetitionsController::class,'destroy'])->name('competitions.destroy');

});



Route::middleware("guest")->group(function () {

    Route::get("/login", [AuthController::class, "login"])->name("login");
    Route::post("/login", [AuthController::class, "loginPost"])->name("login.post");

    Route::get("/register", [AuthController::class, "register"])->name("register");
    Route::post("/register", [AuthController::class, "registerPost"])->name(name: "register.post");
});