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

// 🏠 Landing Page
Route::get('/', fn () => view('welcome'))->name('home');

// 👤 Authenticated User Dashboard
Route::view('/dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

// 📦 Booking Search (User Side)
Route::get('/check-booking', [BookingSearchController::class, 'index'])->name('bookings.search');
Route::post('/check-booking', [BookingSearchController::class, 'search'])->name('bookings.search.result');

// 🎨 Studio Booking (View & Submit)
Route::view('/Studio', 'Studio')->name('Studio');
Route::post('/studio-booking', [StudioBookingController::class, 'store'])->name('studio.booking.store');

// 👗 Busana (Outfit Booking Page for Users and Admins)
Route::get('/busana', function () {
    $type = request('type');
    $gender = request('gender');

    $outfits = \App\Models\Outfit::query();

    if ($type && $type !== 'all') {
        $outfits->where('type', $type);
    }

    if ($gender && $gender !== 'all') {
        $outfits->where('gender', $gender);
    }

    $outfits = $outfits->get();

    if (Auth::check() && Auth::user()->role === 'admin') {
        $bookings = \App\Models\OutfitBooking::with('outfit')->latest()->get();
        return view('admin.outfits.busana-admin', compact('outfits', 'bookings'));
    }

    return view('user.busana', compact('outfits'));
})->name('busana');


// 🧾 Store form input into session
Route::post('/busana/confirm', [StudioBookingController::class, 'confirmPreview'])->name('busana.confirm');

// ✅ Final confirmation page (submit)
Route::post('/busana/final-submit', [StudioBookingController::class, 'finalSubmit'])->name('busana.final');


// 📟 Outfit Booking Submission (User)
Route::post('/busana/book', [StudioBookingController::class, 'storeBusanaBooking'])->name('busana.book');

// ⚙️ Authenticated User Settings (Livewire Volt)
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

// 🔐 Auth Routes (Login, Register, etc.)
require __DIR__ . '/auth.php';

// 🛡️ Admin-Only Routes
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminHomeController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings');
    Route::post('/admin/bookings/{id}/accept', [AdminBookingController::class, 'accept'])->name('admin.bookings.accept');
    Route::post('/admin/bookings/{id}/reject', [AdminBookingController::class, 'reject'])->name('admin.bookings.reject');

    // 👕 Outfit CRUD Routes
    Route::post('/busana/add-outfit', [StudioBookingController::class, 'createOutfit'])->name('outfit.create');
    Route::get('/admin/outfits/{id}/edit', [StudioBookingController::class, 'editOutfit'])->name('outfit.edit');
    Route::put('/busana/update-outfit/{id}', [StudioBookingController::class, 'updateOutfit'])->name('outfit.update');
    Route::delete('/busana/delete-outfit/{id}', [StudioBookingController::class, 'deleteOutfit'])->name('outfit.delete');

    Route::get('/admin/outfit-bookings', [StudioBookingController::class, 'viewOutfitBookings'])->name('admin.outfit.bookings');
    Route::post('/admin/outfit-bookings/{id}/accept', [StudioBookingController::class, 'acceptOutfitBooking'])->name('admin.outfit.accept');
    Route::post('/admin/outfit-bookings/{id}/reject', [StudioBookingController::class, 'rejectOutfitBooking'])->name('admin.outfit.reject');
    Route::post('/admin/outfit-bookings/{id}/handle', [StudioBookingController::class, 'handleDecision'])->name('admin.outfit.handle');
});