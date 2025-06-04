<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\Admin\DescriptionController;
use App\Http\Controllers\Admin\ProfileController;

// Guest (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [SessionController::class, 'index'])->name('login');
    Route::post('/sesi/login', [SessionController::class, 'login']);
});

// Logout route
Route::get('/sesi/logout', [SessionController::class, 'logout'])->name('logout');

// Admin (harus login)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('descriptions', DescriptionController::class);
    Route::resource('profiles', ProfileController::class);
});
