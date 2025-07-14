<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('dashboard.name', 'Vestario') }} - @yield('title', 'Dashboard')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: url('https://permohonanupu.com/wp-content/uploads/2023/02/Bangunan-Suluh-Budiman2-1024x686-1.jpeg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        .navbar {
            background-color: rgba(255, 255, 255, 0.9) !important;
            backdrop-filter: blur(6px);
        }

        .container1 {
            max-width: 1200px;
            margin: auto;
            padding: 30px;
            background-color: rgba(255, 255, 255, 0.92); /* translucent white */
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        .outfit-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .outfit-card {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 15px;
            background-color: #fff;
            transition: 0.3s ease-in-out;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.03);
            text-align: center;
        }

        .outfit-title {
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 6px;
            text-align: center;
        }

        .img-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .gallery-img {
            width: 100%;
            max-width: 220px;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body>

    <!-- Header Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
        <div class="container">
            
        <img src="{{ asset('favicon.svg') }}" alt="icon" class="navbar-brand me-2" style="width: 50px; height: 50px;">    
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">Vestario</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item mb-2"><a href="{{ route('Studio') }}" class="nav-link">Studio</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('busana') }}" class="nav-link">Outfit</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('bookings.search') }}" class="nav-link">My Booking</a></li>
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
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
                                            <button type="submit" class="dropdown-item">🚪 Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-sm me-2">Log in</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="btn btn-outline-dark btn-sm">Register</a>
                                </li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Page Content -->
    <main class="py-4">
        <div class="container1">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="text-center text-muted mt-5 mb-3 small">
        &copy; {{ date('Y') }} Vestario. All rights reserved.
    </footer>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
