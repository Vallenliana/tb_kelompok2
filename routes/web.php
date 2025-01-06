<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UmrohTicketController;
use App\Http\Controllers\JamaahBookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\JamaahController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route Dashboard
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('welcome');
})->middleware(['auth', 'redirect.role'])->name('dashboard');

// Route Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Kelola Tiket Umroh
    Route::get('/umroh-tickets', [UmrohTicketController::class, 'index'])->name('umroh-tickets.index');
    Route::get('/umroh-tickets/create', [UmrohTicketController::class, 'create'])->name('umroh-tickets.create');
    Route::post('/umroh-tickets', [UmrohTicketController::class, 'store'])->name('umroh-tickets.store');
    Route::get('/umroh-tickets/{ticket}/edit', [UmrohTicketController::class, 'edit'])->name('umroh-tickets.edit');
    Route::put('/umroh-tickets/{ticket}', [UmrohTicketController::class, 'update'])->name('umroh-tickets.update');
    Route::delete('/umroh-tickets/{ticket}', [UmrohTicketController::class, 'destroy'])->name('umroh-tickets.destroy');

    // Kelola Pemesanan
    Route::get('/bookings', [AdminController::class, 'bookingIndex'])->name('bookings.index');
    Route::get('/bookings/{booking}', [AdminController::class, 'bookingShow'])->name('bookings.show');
    Route::put('/bookings/{booking}/confirm', [AdminController::class, 'confirmBooking'])->name('bookings.confirm');
    Route::put('/bookings/{booking}/reject', [AdminController::class, 'rejectBooking'])->name('bookings.reject');

    // Kelola Pembayaran
    Route::get('/payments', [AdminController::class, 'paymentIndex'])->name('payments.index');

    // Profile Admin
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::put('/profile/update', [AdminController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [AdminController::class, 'updatePassword'])->name('profile.password');
});

// Route Jamaah (Hapus middleware verified)
Route::middleware(['auth', 'jamaah'])->prefix('jamaah')->name('jamaah.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [JamaahBookingController::class, 'dashboard'])->name('dashboard');

    // Lihat Paket Umroh
    Route::get('/packages', [JamaahBookingController::class, 'packages'])->name('packages.index');

    // Kelola Pemesanan
    Route::get('/bookings', [JamaahBookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create', [JamaahBookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [JamaahBookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}', [JamaahBookingController::class, 'show'])->name('bookings.show');
    Route::put('/bookings/{booking}/cancel', [JamaahBookingController::class, 'cancel'])->name('bookings.cancel');

    // Pembayaran
    Route::get('/bookings/{booking}/payment', [JamaahBookingController::class, 'showPayment'])->name('bookings.payment');
    Route::post('/bookings/{booking}/payment', [JamaahBookingController::class, 'submitPayment'])->name('bookings.payment.store');

    // Profile Jamaah
    Route::get('/profile', [JamaahController::class, 'profile'])->name('profile');
    Route::put('/profile/update', [JamaahController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [JamaahController::class, 'updatePassword'])->name('profile.password');
});

// Route Autentikasi
require __DIR__ . '/auth.php';
