<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompetitionsController;
use App\Http\Controllers\CompetitorsController;
use App\Http\Controllers\RoundsController;
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

    //Rounds
    Route::get('/rounds/index',[RoundsController::class,'index'])->name('rounds.index');
    Route::get('/rounds/create',[RoundsController::class,'create'])->name('rounds.create');
    Route::post('/rounds/store',[RoundsController::class,'store'])->name('rounds.store');
    Route::get('/rounds/{id}/edit',[RoundsController::class,'edit'])->name('rounds.edit');
    Route::delete('/rounds/{id}/delete',[RoundsController::class,'destroy'])->name('rounds.destroy');

    //Competitors
    Route::get('/competitors/index',[CompetitorsController::class,'index'])->name('competitors.index');
    Route::get('/competitors/create',[CompetitorsController::class,'create'])->name('competitors.create');
    Route::post('/competitors/store',[CompetitorsController::class,'store'])->name('competitors.store');
    Route::get('/competitors/{user_email}/{round_id}/edit',[CompetitorsController::class,'edit'])->name('competitors.edit');
    Route::delete('/competitors/{user_email}/{round_id}/delete',[CompetitorsController::class,'destroy'])->name('competitors.destroy');

});



Route::middleware("guest")->group(function () {


    Route::get("/login", [AuthController::class, "login"])->name("login");
    Route::post("/login", [AuthController::class, "loginPost"])->name("login.post");

    Route::get("/register", [AuthController::class, "register"])->name("register");
    Route::post("/register", [AuthController::class, "registerPost"])->name(name: "register.post");
});