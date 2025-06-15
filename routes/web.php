<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\FieldsController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// Admin routes menggunakan alias middleware 'role'
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.') // penting untuk admin.fields.*
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Tambahkan resource route untuk fields
        Route::resource('/fields', FieldsController::class);
    });

// Setelah login, redirect ke dashboard sesuai role
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        
        return app(UserDashboardController::class)->index();
    })->name('dashboard');
    
    Route::get('/fields', [FieldsController::class, 'index'])->name('fields');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
