<?php

use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Data kursus sementara (sebelum ada database)
$courses = [
    1 => ['name' => 'Web Dasar Banget',    'remaining' => 12],
    2 => ['name' => 'PHP Dasar',           'remaining' => 8],
    3 => ['name' => 'Laravel Fundamental', 'remaining' => 4],
    4 => ['name' => 'UI Web Dasar',        'remaining' => 10],
];

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/pendaftaran', function () use ($courses) {
    return view('enrollments.create', compact('courses'));
})->name('enrollments.create');

Route::post('/pendaftaran/preview', function (Request $request) use ($courses) {
    $request->validate([
        'name'      => ['required', 'string', 'min:3', 'max:100'],
        'email'     => ['required', 'email'],
        'course_id' => ['required', 'integer', 'in:' . implode(',', array_keys($courses))],
    ]);

    return back()
        ->with('success', 'Form lolos validasi. Database akan ditambahkan pada pertemuan berikutnya.')
        ->withInput();
})->name('enrollments.preview');

Route::get('/courses/{course}/availability', function (int $course) use ($courses) {
    abort_unless(isset($courses[$course]), 404);

    return response()->json([
        'course'    => $courses[$course]['name'],
        'remaining' => $courses[$course]['remaining'],
    ]);
})->whereNumber('course')->name('courses.availability');