<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-gradient-to-br from-zinc-100 to-zinc-300 dark:from-neutral-950 dark:to-neutral-900 antialiased">

    <div class="flex min-h-screen items-center justify-center px-4">
        <div class="w-full max-w-md bg-white dark:bg-zinc-800 rounded-xl shadow-xl p-8">
            
            <!-- Logo + App Name -->
            <div class="flex flex-col items-center mb-6">
                <img src="{{ asset('favicon.svg') }}" alt="Vestario Logo" class="h-14 w-14 mb-2">
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
