<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EnrollmentController;
use Illuminate\Support\Facades\Route;

// Data kursus sementara
$courses = [
    1 => ['name' => 'Web Dasar Banget', 'remaining' => 12],
    2 => ['name' => 'PHP Dasar', 'remaining' => 8],
    3 => ['name' => 'Laravel Fundamental', 'remaining' => 4],
    4 => ['name' => 'UI Web Dasar', 'remaining' => 10],
];

// Halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman pendaftaran
Route::get('/pendaftaran', [EnrollmentController::class, 'create'])
    ->name('enrollments.create');

// Mengecek ketersediaan kursus
Route::get('/courses/{course}/availability', function (int $course) use ($courses) {
    abort_unless(isset($courses[$course]), 404);

    return response()->json([
        'course' => $courses[$course]['name'],
        'remaining' => $courses[$course]['remaining'],
    ]);
})->whereNumber('course')->name('courses.availability');

// CRUD Courses
Route::resource('courses', CourseController::class);

// CRUD Enrollment
Route::resource('enrollments', EnrollmentController::class)
    ->only(['index', 'store']);