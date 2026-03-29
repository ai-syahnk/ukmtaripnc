<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TariController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('web.beranda');
});

Route::get('/beranda', function () {
    return view('web.beranda');
});

// Route untuk user belum login (guest)
Route::middleware('guest')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'showLogin')->name('login');
        Route::post('/login', 'login')->name('login.proses');
        Route::get('/register', 'showRegister')->name('register');
        Route::post('/register', 'register')->name('register.proses');
    });
});

// Route untuk user yang sudah login (auth)
Route::middleware('auth')->group(function () {
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('tari', TariController::class)->except(['show']);
    });

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/booking', [TariController::class, 'bookingIndex'])->name('booking.index');
Route::get('/booking/create', [TariController::class, 'bookingCreate'])->middleware('auth')->name('booking.create');
