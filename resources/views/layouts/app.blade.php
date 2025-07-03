<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vestario Booking</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <h1>Vestario Booking System</h1>
    </header>

    <main class="py-4">
        @yield('content')
    </main>
</body>
</html>
