<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Modern and professional admin platform built with Laravel">
    <title>{{ config('app.name') }} - Professional Admin Platform</title>

    <!-- Tabler CSS -->
    <link href="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/css/tabler.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .landing-hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 2rem 0;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .hero-title {
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            color: white;
        }

        .hero-subtitle {
            font-size: clamp(1rem, 2vw, 1.25rem);
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .btn-hero {
            padding: 0.75rem 2rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-hero:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .feature-card {
            transition: all 0.3s ease;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        [data-bs-theme="dark"] body {
            background: linear-gradient(135deg, #1a1d29 0%, #2d3142 100%);
        }

        [data-bs-theme="dark"] .glass-card {
            background: rgba(30, 30, 40, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .navbar-glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        [data-bs-theme="dark"] .navbar-glass {
            background: rgba(30, 30, 40, 0.95);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .brand-logo {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg sticky-top navbar-glass">
        <div class="container">
            <a class="navbar-brand brand-logo" href="/">
                {{ config('app.name', 'AmiraPro') }}
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto">
                    @auth
                        <a href="{{ url('/admin/dashboard') }}" class="btn btn-primary">
                            <i class="ti ti-dashboard me-1"></i>
                            Dashboard
                        </a>
                    @else
                        @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="btn btn-ghost-primary me-2">
                            Login
                        </a>
                        @endif
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary">
                                Get Started
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="landing-hero">
        <div class="container">
            <div class="row align-items-center g-5">
                <!-- Left Column -->
                <div class="col-lg-6 text-center text-lg-start">
                    <h1 class="hero-title">
                        Professional Admin Platform
                    </h1>
                    <p class="hero-subtitle">
                        Build and manage your applications with confidence. Powered by Laravel 12, secure authentication, and modern UI components.
                    </p>

                    <div class="d-flex gap-3 justify-content-center justify-content-lg-start flex-wrap">
                        @guest
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-white btn-hero">
                                <i class="ti ti-rocket me-2"></i>
                                Start Free
                            </a>
                            @endif
                            @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="btn btn-outline-light btn-hero">
                                <i class="ti ti-login me-2"></i>
                                Sign In
                            </a>
                            @endif
                        @else
                            <a href="{{ url('/admin/dashboard') }}" class="btn btn-white btn-hero">
                                <i class="ti ti-dashboard me-2"></i>
                                Go to Dashboard
                            </a>
                        @endguest
                    </div>
                </div>

                <!-- Right Column - Stats -->
                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="card glass-card text-center p-4">
                                <div class="stats-number">100%</div>
                                <div class="text-muted">Secure</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card glass-card text-center p-4">
                                <div class="stats-number">Fast</div>
                                <div class="text-muted">Performance</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card glass-card text-center p-4">
                                <div class="stats-number">24/7</div>
                                <div class="text-muted">Support</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card glass-card text-center p-4">
                                <div class="stats-number">Easy</div>
                                <div class="text-muted">To Use</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="display-6 fw-bold mb-3">Everything You Need</h2>
                <p class="text-muted fs-5">Powerful features for modern web applications</p>
            </div>

            <div class="row g-4">
                <!-- Feature 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card feature-card border-0 shadow-sm p-4">
                        <div class="feature-icon mb-3">
                            <i class="ti ti-shield-check fs-1"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Secure Authentication</h4>
                        <p class="text-muted">
                            Advanced security with Laravel Sanctum, OAuth integration (Google/GitHub), and role-based access control.
                        </p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card feature-card border-0 shadow-sm p-4">
                        <div class="feature-icon mb-3">
                            <i class="ti ti-users fs-1"></i>
                        </div>
                        <h4 class="fw-bold mb-3">User Management</h4>
                        <p class="text-muted">
                            Complete user management with roles, permissions, activation system, and detailed profiles.
                        </p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card feature-card border-0 shadow-sm p-4">
                        <div class="feature-icon mb-3">
                            <i class="ti ti-palette fs-1"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Modern UI</h4>
                        <p class="text-muted">
                            Beautiful interface built with Tabler UI, dark mode support, and responsive design.
                        </p>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card feature-card border-0 shadow-sm p-4">
                        <div class="feature-icon mb-3">
                            <i class="ti ti-database fs-1"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Data Tables</h4>
                        <p class="text-muted">
                            Powerful server-side data tables with search, filter, sorting, and export capabilities.
                        </p>
                    </div>
                </div>

                <!-- Feature 5 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card feature-card border-0 shadow-sm p-4">
                        <div class="feature-icon mb-3">
                            <i class="ti ti-mail fs-1"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Email System</h4>
                        <p class="text-muted">
                            Built-in email notifications, password reset, and customizable email templates.
                        </p>
                    </div>
                </div>

                <!-- Feature 6 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card feature-card border-0 shadow-sm p-4">
                        <div class="feature-icon mb-3">
                            <i class="ti ti-chart-line fs-1"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Analytics</h4>
                        <p class="text-muted">
                            Track user activity, monitor system performance, and view key metrics in real-time.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="container py-5 text-center">
            <h2 class="display-5 fw-bold mb-4">Ready to Get Started?</h2>
            <p class="fs-5 mb-4 opacity-90">
                Join thousands of users managing their applications with confidence
            </p>
            @guest
                @if (Route::has('register') || Route::has('login'))
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-white btn-lg px-5">
                        <i class="ti ti-rocket me-2"></i>
                        Create Free Account
                    </a>
                    @endif
                    @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-5">
                        <i class="ti ti-login me-2"></i>
                        Sign In
                    </a>
                    @endif
                </div>
                @endif
            @else
                <a href="{{ url('/admin/dashboard') }}" class="btn btn-white btn-lg px-5">
                    <i class="ti ti-dashboard me-2"></i>
                    Go to Dashboard
                </a>
            @endguest
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-top py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <p class="text-muted mb-0">
                        &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="text-muted mb-0">
                        Built with <span class="text-danger">❤</span> using Laravel {{ app()->version() }}
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Tabler JS -->
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/js/tabler.min.js"></script>
</body>
</html>
