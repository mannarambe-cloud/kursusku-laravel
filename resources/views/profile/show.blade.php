@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')

<div class="d-flex justify-content-between align-items-start mb-3">
    <div>
        <h2 class="fw-bold">Profil Saya</h2>
        <p class="text-muted">
            Perbarui identitas, kontak, email login, dan password Anda.
        </p>
    </div>

    <a href="{{ route('home') }}" class="btn btn-outline-secondary">
        Kembali ke Beranda
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any() && !$errors->hasBag('password'))
    <div class="alert alert-danger">
        Periksa kembali data yang kamu masukkan.
    </div>
@endif

<div class="row g-4">

    <div class="col-lg-8">

        <div class="card shadow-sm">
            <div class="card-body p-4">

                <h4 class="mb-3">Identitas & Kontak</h4>

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap *</label>

                            <input name="name"
                                value="{{ old('name', $user->name) }}"
                                class="form-control @error('name') is-invalid @enderror">

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email Login *</label>

                            <input name="email"
                                type="email"
                                value="{{ old('email', $user->email) }}"
                                class="form-control @error('email') is-invalid @enderror">

                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Nomor HP</label>

                            <input name="phone"
                                value="{{ old('phone', $user->phone) }}"
                                class="form-control"
                                placeholder="081234567890">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Jabatan</label>

                            <input name="jabatan"
                                value="{{ old('jabatan', $user->jabatan) }}"
                                class="form-control">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Instansi / Unit</label>

                            <input name="instansi"
                                value="{{ old('instansi', $user->instansi) }}"
                                class="form-control">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Alamat</label>

                            <textarea name="alamat"
                                rows="3"
                                class="form-control">{{ old('alamat', $user->alamat) }}</textarea>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-success mt-3">
                        Simpan Perubahan
                    </button>

                </form>

            </div>
        </div>

    </div>

    <div class="col-lg-4">

        <div class="card shadow-sm mb-4">
            <div class="card-body">

                <h5 class="mb-3">Informasi Akses</h5>

                <dl class="row mb-0">

                    <dt class="col-5 fw-normal text-muted">Username</dt>
                    <dd class="col-7 text-end">{{ $user->username ?? '-' }}</dd>

                    <dt class="col-5 fw-normal text-muted">Role</dt>
                    <dd class="col-7 text-end">
                        <span class="badge bg-dark">
                            {{ strtoupper($user->role ?? 'user') }}
                        </span>
                    </dd>

                    <dt class="col-5 fw-normal text-muted">Status</dt>
                    <dd class="col-7 text-end">
                        <span class="badge bg-success">
                            {{ ucfirst($user->status ?? 'aktif') }}
                        </span>
                    </dd>

                    <dt class="col-5 fw-normal text-muted">Login terakhir</dt>
                    <dd class="col-7 text-end">
                        {{ optional($user->last_login_at)->format('d/m/Y H:i') ?? '-' }}
                    </dd>

                </dl>

            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                <h5>Ganti Password</h5>

                <p class="text-muted small">
                    Password baru minimal 8 karakter, mengandung huruf besar,
                    huruf kecil, angka, dan simbol.
                </p>

                <form method="POST" action="{{ route('profile.password') }}">
                    @csrf
                    @method('PUT')

                    <input type="password"
                        name="current_password"
                        class="form-control mb-2"
                        placeholder="Password saat ini">

                    @error('current_password', 'password')
                        <div class="text-danger small mb-2">{{ $message }}</div>
                    @enderror

                    <input type="password"
                        name="password"
                        class="form-control mb-2"
                        placeholder="Password baru">

                    @error('password', 'password')
                        <div class="text-danger small mb-2">{{ $message }}</div>
                    @enderror

                    <input type="password"
                        name="password_confirmation"
                        class="form-control mb-3"
                        placeholder="Konfirmasi password baru">

                    <button type="submit" class="btn btn-outline-dark w-100">
                        Ganti Password
                    </button>

                </form>

            </div>
        </div>

    </div>

</div>

@endsection