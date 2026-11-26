<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ProfileController;

// =====================================
// HALAMAN UTAMA
// =====================================

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

// =====================================
// LOGIN DAN REGISTER
// =====================================

Route::middleware('guest')->group(function () {

    // HALAMAN LOGIN
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    // PROSES LOGIN
    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');

    // HALAMAN REGISTER
    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    // PROSES REGISTER
    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.process');

    // LUPA PASSWORD
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])
        ->name('password.request');

    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])
        ->name('password.email');

    // RESET PASSWORD
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])
        ->name('password.reset');

    Route::post('/reset-password', [AuthController::class, 'resetPassword'])
        ->name('password.update');
});

// =====================================
// HALAMAN SETELAH LOGIN
// =====================================

Route::middleware('auth')->group(function () {

    // DASHBOARD
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // LOGOUT
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // =================================
    // PROFIL PENGGUNA
    // =================================

    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile.index');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
        ->name('profile.password');

    // =================================
    // DATA KURSUS
    // =================================

    Route::resource('courses', CourseController::class);

    // =================================
    // PENDAFTARAN KURSUS
    // =================================

    Route::get('/pendaftaran', [EnrollmentController::class, 'create'])
        ->name('enrollments.create');

    Route::post('/enrollments', [EnrollmentController::class, 'store'])
        ->name('enrollments.store');

    Route::get('/enrollments', [EnrollmentController::class, 'index'])
        ->name('enrollments.index');
});