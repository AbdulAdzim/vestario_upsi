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


// 📦 Booking Search (User Side)
Route::get('/check-booking', [BookingSearchController::class, 'index'])->name('bookings.search');
Route::post('/check-booking', [BookingSearchController::class, 'search'])->name('bookings.search.result');


// 📝 Studio Booking Form Submission
Route::post('/studio-booking', [StudioBookingController::class, 'store'])->name('studio.booking.store');

// 🏠 Landing Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// 📄 Studio Booking Page View
Route::view('/Studio', 'Studio')->name('Studio');

// 📄 View route for busana page (likely another booking or static page)
Route::view('/busana', 'busana')->name('busana');

// 👤 Authenticated User Dashboard
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// ⚙️ Authenticated User Settings (Livewire Volt)
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

// 🔐 Auth Routes (Login, Register, etc.)
require __DIR__.'/auth.php';

// 🛡️ Admin Routes
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminHomeController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings');
    Route::post('/admin/bookings/{id}/accept', [AdminBookingController::class, 'accept'])->name('admin.bookings.accept');
    Route::post('/admin/bookings/{id}/reject', [AdminBookingController::class, 'reject'])->name('admin.bookings.reject');
    Route::post('/busana/add-outfit', [StudioBookingController::class, 'createOutfit'])->name('outfit.create');
    Route::delete('/busana/delete-outfit/{id}', [StudioBookingController::class, 'deleteOutfit'])->name('outfit.delete');
    Route::get('/busana/edit-outfit/{id}', [StudioBookingController::class, 'editOutfit'])->name('outfit.edit');
    Route::post('/busana/update-outfit/{id}', [StudioBookingController::class, 'updateOutfit'])->name('outfit.update');
});
