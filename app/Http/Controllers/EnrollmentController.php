<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EnrollmentController extends Controller
{
    // Menampilkan form tambah enrollment
    public function create()
    {
        // Mengambil seluruh data participant
        $participants = Participant::orderBy('name')->get();

        // Mengambil course yang statusnya open
        $courses = Course::where('status', 'open')
            ->orderBy('name')
            ->get();

        // Mengirim data ke halaman create
        return view('enrollments.create', compact(
            'participants',
            'courses'
        ));
    }

    // Menyimpan data enrollment
    public function store(Request $request)
    {
        // Validasi data
        $data = $request->validate([
            'participant_id' => [
                'required',
                'exists:participants,id'
            ],

            'course_id' => [
                'required',

                // SUDAH DIPERBAIKI: status active menjadi open
                Rule::exists('courses', 'id')
                    ->where('status', 'open'),

                // Mencegah participant mendaftar course yang sama dua kali
                Rule::unique('enrollments', 'course_id')
                    ->where(function ($query) use ($request) {
                        return $query->where(
                            'participant_id',
                            $request->participant_id
                        );
                    }),
            ],
        ], [
            'participant_id.required' =>
                'Participant wajib dipilih.',

            'participant_id.exists' =>
                'Participant tidak ditemukan.',

            'course_id.required' =>
                'Course wajib dipilih.',

            'course_id.exists' =>
                'Course tidak tersedia atau tidak aktif.',

            'course_id.unique' =>
                'Participant ini sudah terdaftar pada course tersebut.',
        ]);

        // Menentukan status enrollment
        $data['status'] = 'registered';

        // Menyimpan data ke database
        Enrollment::create($data);

        // Kembali ke halaman laporan
        return redirect()
            ->route('enrollments.index')
            ->with('success', 'Enrollment berhasil disimpan.');
    }

    // Menampilkan laporan enrollment
    public function index()
    {
        $enrollments = Enrollment::with([
            'participant',
            'course'
        ])
            ->latest()
            ->get();

        return view(
            'enrollments.index',
            compact('enrollments')
        );
    }
}