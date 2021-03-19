<?php

use App\Http\Controllers\LostDogsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Lost Dogs Routes
|--------------------------------------------------------------------------
|
*/
Route::group(["prefix" => "dogs"], function () {
    Route::get("/lost-dogs", [LostDogsController::class, 'index'])
        ->name("lost-dogs")
        ->middleware("permission:read-lost_dogs");

    Route::get("/lost-dog", function () {
        return view("dogs/lost-dog");
    })
        ->name("lost-dogs.new")
        ->middleware("permission:read-lost_dogs");

    Route::get("/lost-dogs/{id}", [LostDogsController::class, 'show'])
        ->name("lost-dogs.show")
        ->middleware("permission:read-lost_dogs");

    Route::delete("/lost-dogs/{id}", [LostDogsController::class, 'destroy'])
        ->name("lost-dogs.destroy")
        ->middleware("permission:delete-lost_dogs");

    Route::post("/lost-dogs", [LostDogsController::class, 'store'])
        ->name("lost-dogs.store")
        ->middleware("permission:create-lost_dogs");

    Route::put("/lost-dogs/{id}", [LostDogsController::class, 'update'])
        ->name("lost-dogs.update")
        ->middleware("permission:update-lost_dogs");
});
