<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// user registration (sign-up)
Route::post('/register', [AuthController::class, 'register']);

// user login
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // user logout
    Route::get('/logout', [AuthController::class, 'logout']);
    // user
    Route::get("/user", [UserController::class, "user"]);

    // create user
    Route::post('/users/create', [UserController::class, 'create'])->middleware('can:users.create');
    Route::get('/users', [UserController::class, 'list'])->middleware('can:users.list');
});
