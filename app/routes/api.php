<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

// Роуты требующие авторизацию
Route::group(["middleware" => "check.auth"],function () {
    Route::resource("reservation", ReservationController::class);
});

// Роуты не требующие авторизации
Route::group([],function () {
    Route::post('login', [AuthController::class,'login']);
});
