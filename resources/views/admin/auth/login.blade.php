<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login | Nullified Solutions</title>
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
            <a href="{{ route('services') }}">Services</a>
            <a href="{{ route('pricing') }}">Pricing</a>
            <a href="{{ route('home') }}#faq">FAQ</a>
            <a href="{{ route('contact') }}">Contact Us</a>
        </nav>

        <a class="header-cta" href="{{ route('login') }}">Customer login <span aria-hidden="true">↗</span></a>
    </header>

    <main class="account-main">
        <section class="account-shell" aria-labelledby="login-title">
            <div class="account-intro">
                <p class="eyebrow">ADMIN PORTAL</p>
                <h1 id="login-title">Admin Access</h1>
                <p class="intro-text">Sign in with your admin account to manage the platform.</p>
            </div>

            <form class="account-form" method="POST" action="{{ route('admin.login') }}" id="adminLoginForm">
                @csrf

                @if ($errors->any())
                    <div class="form-message error" role="alert">
                        <strong>Authentication failed.</strong>
                        {{ $errors->first() }}
                    </div>
                @endif

                @if (session('status'))
                    <div class="form-message success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="form-group">
                    <label for="email">Admin Email</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        placeholder="admin@nullified.com"
                        required
                        autofocus
                        autocomplete="username"
                    />
                    @error('email')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div style="position: relative;">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            placeholder="Enter your admin password"
                            required
                            autocomplete="current-password"
                        />
                        <button
                            type="button"
                            class="toggle-password"
                            aria-label="Toggle password visibility"
                            onclick="togglePasswordVisibility('password', this)"
                        >
                            <i class="fa-regular fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group" style="display: flex; align-items: center; gap: 8px;">
                    <input type="checkbox" name="remember" id="remember" style="width: auto; margin: 0;" />
                    <label for="remember" style="margin: 0; font-weight: 400;">Remember me</label>
                </div>

                <button type="submit" class="btn-primary">
                    Sign in to Admin Portal <span aria-hidden="true">→</span>
                </button>

                <div style="margin-top: 16px; text-align: center;">
                    <a href="{{ route('admin.password.request') }}" style="color: #4f7cff; font-size: 14px;">Reset admin password</a>
                </div>
            </form>
        </section>
    </main>

    <script>
        function togglePasswordVisibility(inputId, button) {
            const input = document.getElementById(inputId);
            const icon = button.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        const menuToggle = document.querySelector('.menu-toggle');
        const navMenu = document.getElementById('navMenu');

        if (menuToggle && navMenu) {
            menuToggle.addEventListener('click', () => {
                const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
                menuToggle.setAttribute('aria-expanded', !isExpanded);
                navMenu.classList.toggle('active');
            });
        }
    </script>
</body>
</html>
