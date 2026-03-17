<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Halaman depan (Landing Page)
Route::get('/', function () {
    return view('welcome');
});

// GROUP ROUTE: Hanya untuk user yang sudah LOGIN
Route::middleware(['auth', 'verified'])->group(function () {

    // 1. ROLE: ADMIN
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('dashboard'); 
        })->name('admin.dashboard');
        
        // Tambahkan route khusus admin lainnya di sini nanti
    });

    // 2. ROLE: BENDAHARA
    Route::middleware(['role:bendahara'])->group(function () {
        Route::get('/bendahara/dashboard', function () {
            return view('dashboard');
        })->name('bendahara.dashboard');

        // Tambahkan route khusus bendahara (input iuran, dll) di sini
    });

    // 3. ROLE: WARGA (Default Dashboard)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // 4. SETTING PROFIL (Bisa diakses SEMUA role yang login)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/logged-out', function () {
    return view('auth.logged-out');
})->name('logged-out');
require __DIR__.'/auth.php';