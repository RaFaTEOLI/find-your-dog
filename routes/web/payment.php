<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Payment Routes
|--------------------------------------------------------------------------
|
*/
Route::group(["prefix" => "dogs"], function () {
    Route::post("/payment", [PaymentController::class, 'store'])
        ->name("payment");
});
