<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Payment Routes
|--------------------------------------------------------------------------
|
*/
Route::group(["middleware" => "auth:sanctum"], function () {
    Route::post('/payment', [PaymentController::class, 'store']);
});
