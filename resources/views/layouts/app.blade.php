<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'KursusKu')</title>

    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    {{-- CSS KUSTOM --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body class="bg-light">

    {{-- MENU NAVIGASI --}}
    @include('partials.navbar')

    {{-- KONTEN HALAMAN --}}
    <main class="container">

        {{-- PESAN BERHASIL --}}
        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        {{-- ISI SETIAP HALAMAN --}}
        @yield('content')

    </main>

    {{-- JAVASCRIPT BOOTSTRAP --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- JAVASCRIPT TAMBAHAN --}}
    @stack('scripts')

</body>
</html>