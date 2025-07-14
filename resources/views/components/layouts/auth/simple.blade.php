<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
    <style>
        body {
            background-color: #f0f4f8;
            color: #333;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .nav-link {
            font-size: 1.1rem;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-zinc-100 to-zinc-300 dark:from-neutral-950 dark:to-neutral-900 antialiased">

    <div class="flex min-h-screen items-center justify-center px-4">
        <div class="w-full max-w-md bg-white dark:bg-zinc-800 rounded-xl shadow-xl p-8">

            <!-- Logo + App Name -->
            <div class="flex flex-col items-center mb-6">
                <img src="{{ asset('favicon.svg') }}" alt="Vestario Logo" class="h-10 w-10 mb-2">
                <h1 class="text-xl font-semibold text-zinc-800 dark:text-zinc-100">Vestario</h1>
            </div>

            <!-- Main Auth Form -->
            <div class="space-y-6">
                {{ $slot }}
            </div>

        </div>
    </div>

    @fluxScripts
</body>
</html>
