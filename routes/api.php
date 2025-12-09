<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrganController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/organ', [OrganController::class, 'index']);
    Route::post('/organ', [OrganController::class, 'store']);
    Route::get('/organ/{id}', [OrganController::class, 'show']);
    Route::post('/organ/{id}', [OrganController::class, 'update']); // jika Flutter sulit PUT
    Route::delete('/organ/{id}', [OrganController::class, 'destroy']);
});


