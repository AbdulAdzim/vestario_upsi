<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\StudioBookingController;
use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\BookingSearchController;
use App\Http\Controllers\OutfitController;
use Illuminate\Support\Facades\Auth;
use App\Models\Outfit;

Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');


// 📦 Booking Search (User Side)
Route::get('/check-booking', [BookingSearchController::class, 'index'])->name('bookings.search');
Route::post('/check-booking', [BookingSearchController::class, 'search'])->name('bookings.search.result');


// 📝 Studio Booking Form Submission
Route::post('/studio-booking', [StudioBookingController::class, 'store'])->name('studio.booking.store');

// 🏠 Landing Page
Route::get('/', function () {return view('welcome');})->name('home');

// 👤 Authenticated User Dashboard
Route::view('/dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

// 📦 Booking Search (User Side)
Route::get('/check-booking', [BookingSearchController::class, 'index'])->name('bookings.search');
Route::post('/check-booking', [BookingSearchController::class, 'search'])->name('bookings.search.result');

// 🎬 Studio Booking (View & Submit)
Route::view('/Studio', 'Studio')->name('Studio');
Route::post('/studio-booking', [StudioBookingController::class, 'store'])->name('studio.booking.store');

// 👗 Busana (Outfit Booking Page via Controller)
Route::get('/busana', [StudioBookingController::class, 'showBusanaPage'])->name('busana');
Route::post('/busana/book', [StudioBookingController::class, 'storeBusanaBooking'])->name('busana.book');

// 👗 Busana Admin (Outfit Booking Page via Route Closure)
Route::get('/busana', [StudioBookingController::class, 'indexOutfits'])->name('busana');

// 👤 User Authentication (Livewire Volt)


// ⚙️ Authenticated User Settings (Livewire Volt)
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

// 🔐 Auth Routes (Login, Register, etc.)
require __DIR__.'/auth.php';

// 🛡️ Admin-Only Routes
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminHomeController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings');
    Route::post('/admin/bookings/{id}/accept', [AdminBookingController::class, 'accept'])->name('admin.bookings.accept');
    Route::post('/admin/bookings/{id}/reject', [AdminBookingController::class, 'reject'])->name('admin.bookings.reject');

    // 👕 Outfit CRUD (admin only)
    Route::post('/busana/add-outfit', [StudioBookingController::class, 'createOutfit'])->name('outfit.create');
    Route::delete('/busana/delete-outfit/{id}', [StudioBookingController::class, 'deleteOutfit'])->name('outfit.delete');
    Route::get('/busana/edit-outfit/{id}', [StudioBookingController::class, 'editOutfit'])->name('outfit.edit');
    Route::post('/busana/update-outfit/{id}', [StudioBookingController::class, 'updateOutfit'])->name('outfit.update');

});

Route::get('/busana', function () {
    $outfits = Outfit::all();

    if (Auth::check() && Auth::user()->role === 'admin') {
        return view('admin.outfits.busana-admin', compact('outfits'));
    } else {
        return view('busana', compact('outfits'));
    }
})->name('busana');