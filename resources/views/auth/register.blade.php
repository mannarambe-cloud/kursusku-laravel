@extends('layouts.app')

@section('title', 'Daftar - Kursusku')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">

        <div class="card shadow-sm">
            <div class="card-body p-4">

                <h2 class="fw-bold">Buat akun baru ✨</h2>
                <p class="text-muted">
                    Daftar untuk mulai belajar di Kursusku.
                </p>

                <form method="POST" action="{{ route('register.process') }}">
                    @csrf

                    <!-- NAMA LENGKAP -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Nama Lengkap
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Masukkan nama lengkap"
                            required
                            autofocus
                        >

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- EMAIL -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="contoh@email.com"
                            required
                        >

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="form-text">
                            Username dibuat otomatis dari bagian email sebelum tanda @.
                        </div>
                    </div>

                    <!-- PASSWORD -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Password
                        </label>

                        <div class="input-group">
                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Masukkan password"
                                required
                            >

                            <button
                                type="button"
                                class="btn btn-outline-secondary"
                                id="togglePassword">
                                Lihat
                            </button>
                        </div>

                        @error('password')
                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="form-text">
                            Minimal 8 karakter.
                        </div>
                    </div>

                    <!-- KONFIRMASI PASSWORD -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Konfirmasi Password
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            class="form-control"
                            placeholder="Ulangi password"
                            required
                        >
                    </div>

                    <!-- TOMBOL DAFTAR -->
                    <button
                        class="btn btn-success w-100"
                        type="submit">
                        Daftar
                    </button>

                </form>

                <!-- LINK LOGIN -->
                <div class="text-center mt-3">
                    <div>
                        Sudah punya akun?
                        <a href="{{ route('login') }}">Masuk</a>
                    </div>

                    <a href="{{ route('home') }}">
                        ← Kembali ke Beranda
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const pw = document.getElementById('password');
        const pw2 = document.getElementById('password_confirmation');
        const btn = document.getElementById('togglePassword');

        if (pw && pw2 && btn) {
            btn.addEventListener('click', function () {

                const show = pw.type === 'password';

                pw.type = show ? 'text' : 'password';
                pw2.type = show ? 'text' : 'password';

                btn.textContent = show ? 'Sembunyi' : 'Lihat';
            });
        }

    });
</script>
@endpush