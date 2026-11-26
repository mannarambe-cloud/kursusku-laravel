@extends('layouts.app')
@section('title', 'Login - Kursusku')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6 col-lg-5">
    <div class="card shadow-sm">
      <div class="card-body p-4">
        <h2 class="fw-bold">Selamat datang 👋</h2>
        <p class="text-muted">Masuk dengan username atau email untuk melanjutkan.</p>

        <form method="POST" action="{{ route('login.process') }}">
          @csrf

          <div class="mb-3">
            <label class="form-label fw-semibold">Username / Email</label>
            <input type="text" name="login" value="{{ old('login') }}"
                   class="form-control @error('login') is-invalid @enderror"
                   placeholder="Masukkan username atau email" autofocus>
            @error('login') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Password</label>
            <div class="input-group">
              <input type="password" name="password" id="password"
                     class="form-control @error('password') is-invalid @enderror"
                     placeholder="Masukkan password">
              <button type="button" class="btn btn-outline-secondary" id="togglePassword">Lihat</button>
              @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
          </div>

          <div class="d-flex justify-content-between mb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="remember" id="remember">
              <label class="form-check-label" for="remember">Ingat saya</label>
            </div>
            <a href="{{ route('password.request') }}">Lupa password?</a>
          </div>

          <button class="btn btn-success w-100" type="submit">Masuk</button>
        </form>

        <div class="text-center mt-3">
          {{-- PERBAIKAN: href sekarang mengarah ke halaman register --}}
          <div>Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a></div>
          <a href="{{ route('home') }}">← Kembali ke Beranda</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  const pw = document.getElementById('password');
  const btn = document.getElementById('togglePassword');
  btn.addEventListener('click', () => {
    const show = pw.type === 'password';
    pw.type = show ? 'text' : 'password';
    btn.textContent = show ? 'Sembunyi' : 'Lihat';
  });
</script>
@endpush