
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'KursusKu')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body class="bg-light">

    <!-- MENU NAVIGASI -->
    <nav class="navbar navbar-expand-lg navbar-dark"
         style="background: linear-gradient(90deg, #6125c5, #8039ed);">

        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                KursusKu
            </a>

            <div class="navbar-nav ms-auto">
                <a class="nav-link text-white" href="{{ url('/') }}">
                    Beranda
                </a>

                <a class="nav-link text-white" href="{{ route('enrollments.create') }}">
                    Pendaftaran
                </a>

                <a class="nav-link text-white" href="{{ route('courses.index') }}">
                    Courses
                </a>
            </div>
        </div>
    </nav>

    <main class="container">

        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>
</html>
