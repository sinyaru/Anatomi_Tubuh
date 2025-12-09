<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

// Login API (tanpa token)
Route::post('/login', [AuthController::class, 'login']);

// Route yang membutuhkan token Sanctum
Route::middleware('auth:sanctum')->group(function () {

    // Ambil data user yang sedang login
    Route::get('/user', [AuthController::class, 'user']);

    // Logout (hapus token)
    Route::post('/logout', [AuthController::class, 'logout']);
});
