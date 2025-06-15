<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AvailabilityController;
use App\Http\Controllers\Api\BookingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Di sini kita mendaftarkan semua API endpoint untuk aplikasi kita.
|
*/


//==========================================================================
// ROUTE PUBLIK (Bisa diakses siapa saja tanpa login)
//==========================================================================

// Endpoint untuk mengecek ketersediaan jadwal lapangan pada tanggal tertentu.
Route::get('/v1/fields/{field}/availability', [AvailabilityController::class, 'check'])->name('api.availability.check');


//==========================================================================
// ROUTE TERPROTEKSI (Hanya bisa diakses oleh pengguna yang sudah login)
//==========================================================================

Route::middleware('auth:sanctum')->group(function () {
    
    // Endpoint untuk mendapatkan data user yang sedang login.
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Tambahkan route ini di dalam grup middleware 'auth:sanctum'
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/v1/bookings', [BookingController::class, 'store'])->name('api.bookings.store');
        // Nanti route lain yang butuh login taruh di sini
    });

});