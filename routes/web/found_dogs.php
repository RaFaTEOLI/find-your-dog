<?php

use App\Http\Controllers\FoundDogsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| found Dogs Routes
|--------------------------------------------------------------------------
|
*/
Route::group(["prefix" => "dogs"], function () {
    Route::get("/found-dogs", [FoundDogsController::class, 'index'])
        ->name("found-dogs")
        ->middleware("permission:read-found_dogs");

    Route::get("/found-dog", function () {
        return view("dogs/found-dog");
    })
        ->name("found-dogs.new")
        ->middleware("permission:read-found_dogs");

    Route::get("/found-dogs/{id}", [FoundDogsController::class, 'show'])
        ->name("found-dogs.show")
        ->middleware("permission:read-found_dogs");

    Route::delete("/found-dogs/{id}", [FoundDogsController::class, 'destroy'])
        ->name("found-dogs.destroy")
        ->middleware("permission:delete-found_dogs");

    Route::post("/found-dogs", [FoundDogsController::class, 'store'])
        ->name("found-dogs.store")
        ->middleware("permission:create-found_dogs");

    Route::put("/found-dogs/{id}", [FoundDogsController::class, 'update'])
        ->name("found-dogs.update")
        ->middleware("permission:update-found_dogs");
});
