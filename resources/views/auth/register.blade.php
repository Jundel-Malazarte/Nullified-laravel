<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up | Nullified Solutions</title>
    <link rel="icon" href="{{ asset('images/Nullified_Logo.png') }}" type="image/png" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="account-page">
    <header>
        <a class="brand" href="{{ route('home') }}" aria-label="Nullified Solutions home">
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

        <a class="header-cta" href="{{ route('register') }}" aria-current="page">Sign up to book <span aria-hidden="true">↗</span></a>
    </header>

    <main class="account-main">
        <section class="account-shell" aria-labelledby="signup-title">
            <div class="account-intro">
                <p class="eyebrow">YOUR REPAIR, ON YOUR TIME</p>
                <h1 id="signup-title">Make your next repair simpler.</h1>
                <p>Create an account to keep your details ready and book your visit with less back-and-forth.</p>
            </div>

            <div class="account-form-wrap">
                <p class="eyebrow">JOIN NULLIFIED SOLUTIONS</p>
                <h2>Create your account</h2>
                <p>Start with the basics. You can update your details anytime.</p>

                @if ($errors->any())
                    <div class="form-message error">
                        {{ $errors->first() }}
                    </div>
                @endif

                <button class="account-google" type="button"><span aria-hidden="true">G</span> Continue with Google</button>
                <div class="account-divider"><span>or use your email</span></div>

                <form class="account-form" method="POST" action="{{ route('register') }}" id="signupForm">
                    @csrf

                    <label>Full name
                        <input
                            type="text"
                            name="name"
                            placeholder="Your name"
                            autocomplete="name"
                            value="{{ old('name') }}"
                            required
                        />
                    </label>

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
                                id="password"
                                name="password"
                                placeholder="At least 8 characters"
                                minlength="8"
                                autocomplete="new-password"
                                required
                            />
                            <button type="button" class="password-toggle" data-target="password" aria-label="Show password">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </div>
                    </label>

                    <label>Confirm password
                        <div class="password-wrap">
                            <input
                                type="password"
                                id="confirm-password"
                                name="password_confirmation"
                                placeholder="Re-enter your password"
                                minlength="8"
                                autocomplete="new-password"
                                required
                            />
                            <button type="button" class="password-toggle" data-target="confirm-password" aria-label="Show password">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </div>
                    </label>

                    <button type="submit">Create account <span aria-hidden="true">↗</span></button>
                </form>

                <p class="account-note">By creating an account, you agree to receive appointment updates from Nullified Solutions.</p>
                <p class="account-switch">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
            </div>
        </section>
    </main>

    <footer><p>© 2026 Nullified Solutions</p></footer>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>