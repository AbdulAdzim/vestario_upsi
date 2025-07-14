@extends('layouts.visitor')

@section('content')
<div class="relative min-h-screen flex items-center justify-center px-4 py-16 bg-white dark:bg-neutral-900 overflow-hidden">

    <!-- Subtle Background Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-zinc-100 to-white dark:from-neutral-800 dark:to-neutral-900 opacity-80"></div>

    <!-- Abstract SVG Pattern (dots) -->
    <div class="absolute inset-0 bg-[url('/images/pattern-dots.svg')] bg-center bg-repeat opacity-5 dark:opacity-10 pointer-events-none"></div>

    <!-- Main Content -->
    <div class="relative z-10 w-full max-w-3xl text-center space-y-10">
        
        <!-- Logo -->
        <div class="flex justify-center">
            <img src="{{ asset('favicon.svg') }}" alt="Vestario Logo" class="h-16 w-16 rounded-sm">
        </div>

        <!-- App Name & Tagline -->
        <div>
            <h1 class="text-3xl md:text-4xl font-semibold text-zinc-800 dark:text-white">Vestario</h1>
            <p class="mt-2 text-zinc-500 dark:text-zinc-400 text-base md:text-lg">
                Effortless booking of traditional Busana outfits and studio rentals.
            </p>
        </div>

        

    </div>

</div>
@endsection
