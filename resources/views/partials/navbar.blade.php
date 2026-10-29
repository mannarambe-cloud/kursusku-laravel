<header class="navbar">
    <div class="container">
        <a class="brand" href="{{ route('home') }}">
            {{ $siteName ?? 'KursusKu' }}
        </a>

        <button class="nav-toggle" id="navToggle" type="button"
                aria-controls="mainNavbar"
                aria-expanded="false"
                aria-label="Buka navigasi">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav id="mainNavbar" class="nav-menu">
            <a href="{{ route('home') }}"
               class="{{ request()->routeIs('home') ? 'active' : '' }}">
                Beranda
            </a>
            <a href="{{ route('enrollments.create') }}"
               class="{{ request()->routeIs('enrollments.*') ? 'active' : '' }}">
                Pendaftaran
            </a>
        </nav>
    </div>
</header>

<script>
    (function () {
        const toggle = document.getElementById('navToggle');
        const menu = document.getElementById('mainNavbar');

        toggle.addEventListener('click', function () {
            const open = menu.classList.toggle('open');
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        });
    })();
</script>