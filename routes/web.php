<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UmrohTicketController;
use App\Http\Middleware\Admin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/daftar-jamaah-umroh', [UmrohTicketController::class, 'index'])->name('umroh.index');
    Route::get('/daftar-jamaah-umroh/buat', [UmrohTicketController::class, 'add'])->name('umroh.add');
    Route::post('/daftar-jamaah-umroh/buat', [UmrohTicketController::class, 'store'])->name('umroh.store');
    Route::get('/daftar-jamaah-umroh/{id}/edit', [UmrohTicketController::class, 'edit'])->name('umroh.edit');
    Route::put('/daftar-jamaah-umroh/{id}/edit', [UmrohTicketController::class, 'edit_put'])->name('umroh.update');
    Route::delete('/daftar-jamaah-umroh/{id}', [UmrohTicketController::class, 'delete'])->name('umroh.destroy');
});
