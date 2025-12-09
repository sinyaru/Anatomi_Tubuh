<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OrganController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\KontributorController;
use App\Http\Controllers\Api\PenggunaController;
use App\Http\Controllers\Api\InformasiController;
use App\Http\Controllers\Api\QuizController;


Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/organ', [OrganController::class, 'index']);
    Route::post('/organ', [OrganController::class, 'store']);
    Route::get('/organ/{id}', [OrganController::class, 'show']);
    Route::post('/organ/{id}', [OrganController::class, 'update']); // jika Flutter sulit PUT
    Route::delete('/organ/{id}', [OrganController::class, 'destroy']);

        // Kategori
    Route::get('/kategori', [KategoriController::class, 'index']);
    Route::post('/kategori', [KategoriController::class, 'store']);
    Route::get('/kategori/{id}', [KategoriController::class, 'show']);
    Route::post('/kategori/{id}', [KategoriController::class, 'update']);
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy']);

    // Kontributor dashboard
    Route::get('/kontributor/dashboard', [KontributorController::class, 'index']);

    // Pengguna CRUD
    Route::get('/pengguna', [PenggunaController::class, 'index']);
    Route::post('/pengguna', [PenggunaController::class, 'store']);
    Route::get('/pengguna/{id}', [PenggunaController::class, 'show']);
    Route::post('/pengguna/{id}', [PenggunaController::class, 'update']);
    Route::delete('/pengguna/{id}', [PenggunaController::class, 'destroy']);

     // Quiz CRUD
    Route::get('/quiz', [QuizController::class, 'index']);
    Route::post('/quiz', [QuizController::class, 'store']);
    Route::get('/quiz/{id}', [QuizController::class, 'show']);
    Route::post('/quiz/{id}', [QuizController::class, 'update']); // jika PUT sulit di Flutter
    Route::delete('/quiz/{id}', [QuizController::class, 'destroy']);
});


