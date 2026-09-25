<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Nullified Solutions')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v=20260920" />
    <link rel="icon" class="icon" href="{{ asset('images/Nullified_Logo.png') }}" type="image/png" style="border-radius: 50%;" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet"/>
    @stack('styles')
</head>
<body>
    <header class="site-header">
        <a class="brand" href="{{ route('home') }}" aria-label="Nullified Solutions">
            <div class="logo">
                <img src="{{ asset('images/Nullified_Logo.png') }}" alt="Nullified Solutions" />
            </div>
            <div class="logo">Nullified Solutions</div>
        </a>

        <button class="menu-toggle" type="button" aria-label="Toggle navigation" aria-expanded="false">☰</button>

        <nav id="navMenu">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('services.index') }}">Services</a>
            <a href="{{ route('pricing.index') }}">Pricing</a>
            <a href="{{ route('home') }}#faq">FAQ</a>
            <a href="{{ route('contact') }}">Contact Us</a>
        </nav>

        @auth
            <a class="header-cta" href="{{ route('dashboard') }}">Dashboard <span aria-hidden="true">→</span></a>
        @else
            <a class="header-cta" href="{{ route('register') }}">Sign up to book <span aria-hidden="true">↗</span></a>
        @endauth
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>© 2026 Nullified Solutions</p>
    </footer>

    <script src="{{ asset('js/script.js') }}"></script>
    @stack('scripts')
</body>
</html>
