<?php

use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', function () {
        return view('admin.sesi.dashboard');
    })->name('dashboard');
});



Route::get('/login',[SessionController::class,'index']);
Route::get('sesi',[SessionController::class,'index']);
Route::post('/sesi/login',[SessionController::class,'login']);
Route::get('/sesi/logout',[SessionController::class,'logout']);
