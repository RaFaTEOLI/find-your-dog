<?php

use App\Http\Controllers\FoundDogsController;
use App\Http\Controllers\MyDogsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| My Dogs Routes
|--------------------------------------------------------------------------
|
*/
Route::group(["prefix" => "dogs"], function () {
    Route::get("/my-dogs", [MyDogsController::class, 'index'])
        ->name("my-dogs")
        ->middleware("permission:read-found_dogs");
});
