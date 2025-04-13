<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Routes untuk Authentication
Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);

// Routes yg membutuhkan authentication
Route::middleware("auth:sanctum")->group(function () {
    Route::get("/categories", [CategoryController::class, "index"]);
    Route::post("/categories", [CategoryController::class, "store"]);
    Route::get("/categories/{id}", [CategoryController::class, "show"]);
    Route::put("/categories/{id}", [CategoryController::class, "update"]);
    Route::delete("/categories/{id}", [CategoryController::class, "destroy"]);

    Route::get("/courses", [CourseController::class, "index"]);
    Route::post("/courses", [CourseController::class, "store"]);
    Route::get("/courses/{id}", [CourseController::class, "show"]);
    Route::put("/courses/{id}", [CourseController::class, "update"]);
    Route::delete("/courses/{id}", [CourseController::class, "destroy"]);

    Route::post("/logout", [AuthController::class, "logout"]);
});