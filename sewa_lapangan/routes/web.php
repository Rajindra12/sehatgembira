<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\FieldController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PricingRuleController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\Customer\BookingController as CustomerBookingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Utama untuk semua pengunjung
Route::get('/', function () {
    return view('welcome');
});

Route::get('/lapangan', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/lapangan/{field}', [CatalogController::class, 'show'])->name('catalog.show');

// Route "Pintu Masuk" Dashboard SETELAH LOGIN
// Semua pengguna akan diarahkan ke sini, lalu controllernya yang akan mengatur
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');


// --- GRUP ROUTE UNTUK ADMIN ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', function () {
        return 'Tes Halaman Dashboard Admin Berhasil';
    })->name('dashboard');
    Route::resource('fields', FieldController::class);  
    // Tambahkan route admin lainnya di sini
});

// Cari grup route admin/staff Anda
Route::middleware(['auth', 'staff'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('fields', FieldController::class);

    // TAMBAHKAN BARIS INI
    Route::resource('pricing-rules', PricingRuleController::class);

});

// --- GRUP ROUTE UNTUK CUSTOMER ---
Route::middleware(['auth'])->prefix('customer')->name('customer.')->group(function () {
    
    Route::get('/dashboard', function () {
        // Ini menggunakan view 'dashboard.blade.php' yang dibuat oleh Breeze
        return view('dashboard');
    })->name('dashboard'); // Nama lengkapnya: customer.dashboard

    Route::get('/bookings', [CustomerBookingController::class, 'index'])->name('bookings.index');
});


// --- ROUTE PROFIL PENGGUNA (Bawaan Breeze) ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// --- ROUTE OTENTIKASI (Bawaan Breeze) ---
require __DIR__.'/auth.php';