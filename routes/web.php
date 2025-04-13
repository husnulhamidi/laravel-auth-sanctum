<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


use App\Http\Controllers\CategoryController;

Route::get("/categories", [CategoryController::class, "index"]);
Route::post("/categories", [CategoryController::class, "store"]);
Route::get("/categories/{id}", [CategoryController::class, "show"]);
Route::put("/categories/{id}", [CategoryController::class, "update"]);
Route::delete("/categories/{id}", [CategoryController::class, "destroy"]);