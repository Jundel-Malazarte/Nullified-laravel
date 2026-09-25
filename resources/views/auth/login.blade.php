<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Log In | Nullified Solutions</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="icon" href="{{ asset('images/Nullified_Logo.png') }}" type="image/png" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="account-page">
    <header>
        <a class="brand" href="{{ route('home') }}" aria-label="Nullified Solutions">
            <img src="{{ asset('images/Nullified_Logo.png') }}" alt="Nullified Solutions" />
            <span class="logo">Nullified Solutions</span>
        </a>

        <button class="menu-toggle" type="button" aria-label="Toggle navigation" aria-expanded="false">☰</button>

        <nav id="navMenu">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('services.index') }}">Services</a>
            <a href="{{ route('pricing.index') }}">Pricing</a>
            <a href="{{ route('home') }}#faq">FAQ</a>
            <a href="{{ route('contact') }}">Contact Us</a>
        </nav>

        <a class="header-cta" href="{{ route('register') }}">Sign up to book <span aria-hidden="true">↗</span></a>
    </header>

    <main class="account-main">
        <section class="account-shell" aria-labelledby="login-title">
            <div class="account-intro">
                <p class="eyebrow">WELCOME BACK</p>
                <h1 id="login-title">Pick up where you left off.</h1>
                <p>Sign in to manage your details and keep your next repair appointment moving smoothly.</p>
            </div>

            <div class="account-form-wrap">
                <p class="eyebrow">NULLIFIED SOLUTIONS ACCOUNT</p>
                <h2>Log in to your account</h2>
                <p>Enter your details to continue.</p>

                @if ($errors->any())
                    <div class="form-message error">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

                @if (session('status'))
                    <div class="form-message success">{{ session('status') }}</div>
                @endif

                <button class="account-google" type="button"><span aria-hidden="true">G</span> Continue with Google</button>
                <div class="account-divider"><span>or use your email</span></div>

                <form class="account-form" method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf

                    <label>Email address
                        <input
                            type="email"
                            name="email"
                            placeholder="you@example.com"
                            autocomplete="email"
                            value="{{ old('email') }}"
                            required
                        />
                    </label>

                    <label>Password
                        <div class="password-wrap">
                            <input
                                type="password"
                                id="login-password"
                                name="password"
                                placeholder="Your password"
                                autocomplete="current-password"
                                required
                            />
                            <button type="button" class="password-toggle" data-target="login-password" aria-label="Show password">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </div>
                    </label>

                    <button type="submit">Log in <span aria-hidden="true">↗</span></button>
                </form>
                <p class="account-switch">New to Nullified Solutions? <a href="{{ route('register') }}">Create an account</a></p>
            </div>
        </section>
    </main>

    <footer><p>© 2026 Nullified Solutions</p></footer>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
