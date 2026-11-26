@extends('layouts.app')
@section('title', 'Reset Password')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6 col-lg-5">
    <div class="card shadow-sm"><div class="card-body p-4">
      <h3 class="fw-bold">Reset Password</h3>
      <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" value="{{ old('email', $email) }}"
                 class="form-control @error('email') is-invalid @enderror">
          @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Password Baru</label>
          <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
          <div class="form-text">Min. 8 karakter, huruf besar-kecil, angka, dan simbol.</div>
          @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
          <label class="form-label">Konfirmasi Password Baru</label>
          <input type="password" name="password_confirmation" class="form-control">
        </div>
        <button class="btn btn-success w-100">Reset Password</button>
      </form>
    </div></div>
  </div>
</div>
@endsection