<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\StudioBookingController;

Route::post('/studio-booking', [StudioBookingController::class, 'store'])->name('studio.booking.store');

Route::get('/admin/bookings', [StudioBookingController::class, 'index'])->name('admin.bookings');
Route::get('/admin/bookings/{id}/{status}', [StudioBookingController::class, 'updateStatus'])->name('admin.booking.update');
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('/Studio', 'Studio')->name('Studio');
<<<<<<< HEAD

Route::view('/busana', 'busana')->name('busana');




=======
>>>>>>> e0601fde41001ccc0ddf28d3353d44f0b3b7f5b6
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';