<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <title>{{ config('app.name', 'Vestario') }} - @yield('title', 'Home')</title>

    <!-- Bootstrap CSS from CDN (HTTPS is OK) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Load Laravel Vite Assets (uses HTTPS if APP_URL is set properly) -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <style>
        body {
            background-color: #b3b3b3;
            color: #333;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .nav-link {
            font-size: 1.1rem;
        }
        .custom-navbar {
        background-color: #d4edda; /* light green */
        margin: 20px auto;
        padding: 10px 20px;
        border-radius: 1rem;
        max-width: 99%;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15); /* custom shadow */        
        }
    </style>
</head>
<body>

    <!-- Header Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light custom-navbar shadow rounded mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Vestario</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="{{ route('Studio') }}">Studio</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('busana') }}">Busana</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('bookings.search') }}">Check Booking</a></li>

                    @auth
                    <!-- Authenticated User Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="dropdown-item text-muted small">{{ Auth::user()->email }}</li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('settings.profile') }}">
                                    ⚙️ Settings
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        🚪 Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Bootstrap JS from CDN (uses HTTPS) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
