@extends('layouts.app')

@section('title', $siteName)

@section('content')
    <section class="hero">
        <div>
            <h1>Selamat Datang di {{ $siteName }}</h1>
            <p>Pilih kursus unggulan kami dan mulai belajar hari ini.</p>
            <a href="{{ route('enrollments.create') }}">Daftar Sekarang</a>
        </div>

        <img src="{{ asset('images/hero-kursus.jpg') }}" alt="Logo {{ $siteName }}">
    </section>

    <h2 class="section-title">Kursus Unggulan</h2>

    <section class="course-grid">
        @foreach ($featured as $course)
            <article class="card">
                <span class="code">{{ $course['code'] }}</span>
                <h3>{{ $course['name'] }}</h3>
                <p>{{ $course['description'] }}</p>
                <a href="{{ route('enrollments.create') }}">Daftar</a>
            </article>
        @endforeach
    </section>
@endsection