<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#10100f" id="themeColorMeta">
    <script>try{const t=localStorage.getItem("barberhub-theme");if(t==="light"||t==="dark")document.documentElement.setAttribute("data-theme",t)}catch(e){}</script>
    <title>@yield('title', 'BarberHub') | BarberHub</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
    <script defer src="{{ asset('js/theme.js') }}"></script>
</head>
<body>
<header class="site-header">
    <a class="brand" href="{{ route('home') }}"><span class="brand-mark">▥</span> BARBER<span>HUB</span></a>
    <nav>
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('home') }}#services">Services</a>
        <a href="{{ route('home') }}#barbers">Barbers</a>
        <a href="{{ route('about') }}">About</a>
        <a href="{{ route('contact') }}">Contact</a>
        @auth
            @if(auth()->user()->role === 'admin')
                <a class="nav-cta" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
            @elseif(auth()->user()->role === 'customer')
                <a class="nav-cta" href="{{ route('customer.dashboard') }}">My Account</a>
            @endif
        @else
            <a class="nav-cta" href="{{ route('customer.login') }}">Customer Sign In</a>
        @endauth
    </nav>
    <div class="theme-control">
        <span class="theme-label" id="themeLabel">Dark</span>
        <button type="button" class="theme-toggle" id="themeToggle" aria-label="Switch to light appearance" aria-pressed="false">
            <span class="theme-symbol sun" aria-hidden="true">☀</span>
            <span class="theme-symbol moon" aria-hidden="true">☾</span>
            <span class="theme-thumb" aria-hidden="true"></span>
        </button>
    </div>
</header>
<main>@yield('content')</main>
<footer class="footer">
    <strong>BARBERHUB</strong>
    <p>Sharp style. Timeless confidence.</p>
    <p><a href="{{ route('about') }}">About Us</a> &nbsp;·&nbsp; <a href="{{ route('contact') }}">Contact</a></p>
    <p class="footer-admin-link"><a href="{{ route('admin.login') }}">Admin Portal</a></p>
    <div class="footer-team" aria-label="BarberHub project team">
        <strong>PROJECT TEAM</strong>
        <p>Rieljan Obatay Cubillas · Andre Koskie Madelo · Kenrussell Pamisa</p>
    </div>
    <small>© {{ date('Y') }} BarberHub. Academic project demonstration.</small>
</footer>
@stack('scripts')
</body>
</html>
