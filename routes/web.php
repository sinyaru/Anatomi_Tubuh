<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrganController;
use App\Http\Controllers\OrganKontributorController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizKontributorController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\HasilQuizController;
use App\Http\Controllers\HasilQuizKontributorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KontributorController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\InformasiKontributorController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\DashboardPenggunaController;
use App\Http\Controllers\OrganPenggunaController;
use App\Http\Controllers\QuizPenggunaController;
use App\Http\Controllers\HasilQuizPenggunaController;
use App\Http\Controllers\KategoriController;

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route untuk halaman Tentang (Public - bisa diakses tanpa login)
Route::get('/tentang', [InformasiController::class, 'tentang'])
    ->name('tentang');

// Route untuk Organ Tubuh (Public - bisa diakses tanpa login)
// Halaman pilih kategori
Route::get(
    '/pengguna/organ-tubuh',
    [OrganPenggunaController::class, 'kategori']
)->name('pengguna.organ.kategori');

// Halaman list organ berdasarkan kategori
Route::get(
    '/pengguna/organ-tubuh/kategori/{id}',
    [OrganPenggunaController::class, 'index']
)->name('pengguna.organ.byKategori');

// Halaman detail organ
Route::get(
    '/pengguna/organ-tubuh/detail/{id}',
    [OrganPenggunaController::class, 'show']
)->name('pengguna.organ.show');


/*
|--------------------------------------------------------------------------
| AUTH PENGGUNA
|--------------------------------------------------------------------------
*/
Route::get('/login-pengguna', [PenggunaController::class, 'showLoginForm'])
    ->name('login.pengguna');

Route::post('/login-pengguna', [PenggunaController::class, 'login'])
    ->name('login.pengguna.submit');

Route::post('/logout-pengguna', [PenggunaController::class, 'logout'])
    ->name('logout.pengguna');

/*
|--------------------------------------------------------------------------
| DASHBOARD UMUM - AUTO REDIRECT BERDASARKAN ROLE
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    // ✅ Redirect otomatis berdasarkan role
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif (Auth::user()->role === 'kontributor') {
        return redirect()->route('kontributor.dashboard');
    } else {
        return redirect()->route('pengguna.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::put('/profile/password', [PasswordController::class, 'update'])
        ->name('profile.password.update');
});

/*
|--------------------------------------------------------------------------
| ROLE PENGGUNA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:pengguna'])->group(function () {

    Route::get('/pengguna/dashboard', [DashboardPenggunaController::class, 'index'])
        ->name('pengguna.dashboard');

    // Route Organ Tubuh sudah dipindahkan ke PUBLIC (di atas)

    Route::get('/pengguna/quiz', [QuizPenggunaController::class, 'index'])
        ->name('pengguna.quiz.index');

    Route::get('/pengguna/quiz/{id}', [QuizPenggunaController::class, 'show'])
        ->name('pengguna.quiz.show');

    Route::post('/pengguna/quiz/{id}/submit', [QuizPenggunaController::class, 'submit'])
        ->name('pengguna.quiz.submit');

    Route::get('/pengguna/quiz/{id}/ulangi', [QuizPenggunaController::class, 'ulangi'])
        ->name('pengguna.quiz.ulangi');

    Route::get('/pengguna/hasil-quiz', [HasilQuizPenggunaController::class, 'index'])
        ->name('pengguna.hasil-quiz.index');

    Route::get('/pengguna/profil', [DashboardPenggunaController::class, 'profil'])
        ->name('pengguna.profil');

    Route::post('/pengguna/profil/update', [DashboardPenggunaController::class, 'updateProfil'])
        ->name('pengguna.profil.update');

    Route::put('/profil/update-password', [PenggunaController::class, 'updatePassword'])
        ->name('pengguna.profil.update-password');
});

/*
|--------------------------------------------------------------------------
| ROLE ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    // CRUD ORGAN
    Route::resource('/admin/organ', OrganController::class)
        ->names('organ');

    // CRUD QUIZ
    Route::resource('/admin/quiz', QuizController::class)
        ->names('quiz');

    // CRUD INFORMASI
    Route::resource('/admin/informasi', InformasiController::class)
        ->names('informasi');

    // CRUD PENGGUNA
    Route::resource('/admin/pengguna', PenggunaController::class)
        ->names('pengguna');

    // CRUD HASIL QUIZ
    Route::resource('/admin/hasil-quiz', HasilQuizController::class)
        ->names('hasil-quiz');
});

/*
|--------------------------------------------------------------------------
| ROLE KONTRIBUTOR
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:kontributor'])->group(function () {

    Route::get('/kontributor/dashboard', [KontributorController::class, 'index'])
        ->name('kontributor.dashboard');

    // 🔥 CRUD ORGAN untuk Kontributor
    Route::get('/kontributor/organ', [OrganKontributorController::class, 'index'])
        ->name('kontributor.organ.index');
    Route::get('/kontributor/organ/create', [OrganKontributorController::class, 'create'])
        ->name('kontributor.organ.create');
    Route::post('/kontributor/organ', [OrganKontributorController::class, 'store'])
        ->name('kontributor.organ.store');
    Route::get('/kontributor/organ/{id}/edit', [OrganKontributorController::class, 'edit'])
        ->name('kontributor.organ.edit');
    Route::put('/kontributor/organ/{id}', [OrganKontributorController::class, 'update'])
        ->name('kontributor.organ.update');
    Route::delete('/kontributor/organ/{id}', [OrganKontributorController::class, 'destroy'])
        ->name('kontributor.organ.destroy');

    // 🔥 CRUD QUIZ untuk Kontributor
    Route::get('/kontributor/quiz', [QuizKontributorController::class, 'index'])
        ->name('kontributor.quiz.index');
    Route::get('/kontributor/quiz/create', [QuizKontributorController::class, 'create'])
        ->name('kontributor.quiz.create');
    Route::post('/kontributor/quiz', [QuizKontributorController::class, 'store'])
        ->name('kontributor.quiz.store');
    Route::get('/kontributor/quiz/{id}/edit', [QuizKontributorController::class, 'edit'])
        ->name('kontributor.quiz.edit');
    Route::put('/kontributor/quiz/{id}', [QuizKontributorController::class, 'update'])
        ->name('kontributor.quiz.update');
    Route::delete('/kontributor/quiz/{id}', [QuizKontributorController::class, 'destroy'])
        ->name('kontributor.quiz.destroy');

    // 🔥 CRUD INFORMASI untuk Kontributor
    Route::get('/kontributor/informasi', [InformasiKontributorController::class, 'index'])
        ->name('kontributor.informasi.index');
    Route::get('/kontributor/informasi/create', [InformasiKontributorController::class, 'create'])
        ->name('kontributor.informasi.create');
    Route::post('/kontributor/informasi', [InformasiKontributorController::class, 'store'])
        ->name('kontributor.informasi.store');
    Route::get('/kontributor/informasi/{id}/edit', [InformasiKontributorController::class, 'edit'])
        ->name('kontributor.informasi.edit');
    Route::put('/kontributor/informasi/{id}', [InformasiKontributorController::class, 'update'])
        ->name('kontributor.informasi.update');
    Route::delete('/kontributor/informasi/{id}', [InformasiKontributorController::class, 'destroy'])
        ->name('kontributor.informasi.destroy');

    // 🔥 HASIL QUIZ untuk Kontributor (Read Only)
    Route::get('/kontributor/hasil-quiz', [HasilQuizKontributorController::class, 'index'])
        ->name('kontributor.hasil-quiz.index');
    Route::get('/kontributor/hasil-quiz/{id}', [HasilQuizKontributorController::class, 'show'])
        ->name('kontributor.hasil-quiz.show');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('/admin/kategori', KategoriController::class)->names('kategori');
});

require __DIR__ . '/auth.php';
