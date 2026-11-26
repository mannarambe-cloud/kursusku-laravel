@extends('layouts.app')
@section('title', 'Lupa Password')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6 col-lg-5">
    <div class="card shadow-sm"><div class="card-body p-4">
      <h3 class="fw-bold">Lupa Password</h3>
      <p class="text-muted">Masukkan email akun Anda untuk menerima link reset.</p>
      <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" value="{{ old('email') }}"
                 class="form-control @error('email') is-invalid @enderror">
          @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <button class="btn btn-success w-100">Kirim Link Reset</button>
      </form>
      <div class="text-center mt-3"><a href="{{ route('login') }}">← Kembali ke Login</a></div>
    </div></div>
  </div>
</div>
@endsection