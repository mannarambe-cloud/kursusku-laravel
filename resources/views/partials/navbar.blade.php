<header class="navbar">
    <div class="container">

        {{-- LOGO KURSUSKU --}}
        <a class="brand" href="{{ route('home') }}">
            {{ $siteName ?? 'KursusKu' }}
        </a>

        {{-- TOMBOL MENU HP --}}
        <button class="nav-toggle" id="navToggle" type="button"
                aria-controls="mainNavbar"
                aria-expanded="false"
                aria-label="Buka navigasi">
            <span></span>
            <span></span>
            <span></span>
        </button>

        {{-- MENU NAVIGASI --}}
        <nav id="mainNavbar" class="nav-menu">

            {{-- BERANDA --}}
            <a href="{{ route('home') }}"
               class="{{ request()->routeIs('home') ? 'active' : '' }}">
                Beranda
            </a>

            {{-- PENDAFTARAN --}}
            <a href="{{ route('enrollments.create') }}"
               class="{{ request()->routeIs('enrollments.create') ? 'active' : '' }}">
                Pendaftaran
            </a>

            {{-- COURSES --}}
            <a href="{{ route('courses.index') }}"
               class="{{ request()->routeIs('courses.*') ? 'active' : '' }}">
                Courses
            </a>

            {{-- LOGIN JIKA BELUM MASUK --}}
            @guest
                <a href="{{ route('login') }}"
                   class="{{ request()->routeIs('login') ? 'active' : '' }}">
                    Login
                </a>
            @endguest

            {{-- PROFIL DAN LOGOUT JIKA SUDAH MASUK --}}
            @auth

                <a href="{{ route('profile.index') }}"
                   class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">
                    Profil
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link">
                        Logout
                    </button>
                </form>

            @endauth

        </nav>
    </div>
</header>

{{-- JAVASCRIPT MENU RESPONSIVE --}}
<script>
    (function () {
        const toggle = document.getElementById('navToggle');
        const menu = document.getElementById('mainNavbar');

        if (!toggle || !menu) return;

        toggle.addEventListener('click', function () {
            const open = menu.classList.toggle('open');

            toggle.setAttribute(
                'aria-expanded',
                open ? 'true' : 'false'
            );
        });
    })();
</script>