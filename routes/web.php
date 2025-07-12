<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\StudioBookingController;
use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\BookingSearchController;
use App\Http\Controllers\OutfitController;

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('/check-booking', [BookingSearchController::class, 'index'])->name('bookings.search');
Route::post('/check-booking', [BookingSearchController::class, 'search'])->name('bookings.search.result');


// 📝 Route to handle form submission for studio booking (POST method)
Route::post('/studio-booking', [StudioBookingController::class, 'store'])->name('studio.booking.store');

// 🏠 Default home route (landing page)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// 📄 View route for Studio booking page
Route::view('/Studio', 'Studio')->name('Studio');

// 📄 View route for busana page (likely another booking or static page)
Route::view('/busana', 'busana')->name('busana');
Route::get('/outfits', [OutfitController::class, 'index'])->name('outfits.index');

//Route::get('/busana', [OutfitController::class, 'index'])->name('outfits.index');
//Route::get('/busana', [\App\Http\Controllers\OutfitController::class, 'index'])->name('outfits.index');


// 🧑‍💼 Authenticated user dashboard route
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// 🔐 Authenticated-only group: user settings pages using Livewire Volt
Route::middleware(['auth'])->group(function () {
    // ⚙️ Redirect /settings to /settings/profile
    Route::redirect('settings', 'settings/profile');
    
    // 👤 User profile settings
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    
    // 🔑 User password settings
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    
    // 🎨 User appearance/theme settings
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

// 🔐 Auth routes (login, register, etc.)
require __DIR__.'/auth.php';

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminHomeController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings');
    Route::post('/admin/bookings/{id}/accept', [AdminBookingController::class, 'accept'])->name('admin.bookings.accept');
    Route::post('/admin/bookings/{id}/reject', [AdminBookingController::class, 'reject'])->name('admin.bookings.reject');
});