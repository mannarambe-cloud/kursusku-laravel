@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="card shadow-sm">
    <div class="card-body">

        <h3>
            Halo, {{ auth()->user()->name ?? auth()->user()->username ?? 'Pengguna' }} 👋
        </h3>

        <p class="text-muted mb-1">
            Role:
            <span class="badge bg-dark">
                {{ strtoupper(auth()->user()->role ?? 'user') }}
            </span>
        </p>

        <p class="text-muted">
            Anda berhasil login ke Kursusku.
        </p>

        <a href="{{ route('profile.index') }}"
           class="btn btn-success">
            Profil Saya
        </a>

        <form method="POST"
              action="{{ route('logout') }}"
              class="d-inline">

            @csrf

            <button type="submit" class="btn btn-outline-danger">
                Logout
            </button>

        </form>

    </div>
</div>

@endsection