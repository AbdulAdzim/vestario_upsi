<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Vestario') }} - @yield('title', 'Home')</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            min-height: 100vh;
            border-right: 1px solid #dee2e6;
            padding-top: 2rem;
        }
        .sidebar a {
            color: #333;
            text-decoration: none;
        }
        .sidebar a:hover {
            color: #0d6efd;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block bg-white sidebar">
            <div class="px-3">
                <h4 class="fw-bold mb-4">Vestario</h4>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="{{ route('admin.dashboard') }}" class="nav-link">🏠 Home</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('admin.bookings') }}" class="nav-link">🎵 Manage Studio</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('admin.bookings') }}" class="nav-link">👘 Manage Busana</a></li>
                    <li class="nav-item mb-2"><a href="{{ route('bookings.search') }}" class="nav-link">🔍 Check Booking</a></li>

                    <hr>

                    @auth
                        <li class="mb-2">
                            <div class="text-muted small">{{ Auth::user()->name }}</div>
                            <div class="text-muted small mb-2">{{ Auth::user()->email }}</div>
                            <a href="{{ route('settings.profile') }}" class="nav-link">⚙️ Settings</a>
                            <form action="{{ route('logout') }}" method="POST" class="mt-2">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger w-100">🚪 Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="mb-2">
                            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm w-100 mb-2">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-outline-dark btn-sm w-100">Register</a>
                            @endif
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>

        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            @yield('content')
        </main>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
