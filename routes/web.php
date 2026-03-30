<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TariController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'web.beranda');
Route::view('/beranda', 'web.beranda');

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
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('tari', TariController::class)->except(['show']);
        Route::get('/booking', [BookingController::class, 'adminIndex'])->name('booking.index');
        Route::patch('/booking/{booking}/status', [BookingController::class, 'updateStatus'])->name('booking.update-status');

        Route::get('/payment', [PaymentController::class, 'adminIndex'])->name('payment.index');
        Route::patch('/payment/{payment}/verify', [PaymentController::class, 'verify'])->name('payment.verify');
    });

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/booking', [TariController::class, 'bookingIndex'])->name('booking.index');
Route::get('/informasi-booking', [BookingController::class, 'informasiBooking'])->name('booking.info');

Route::middleware('auth')->group(function () {
    Route::get('/booking/history', [BookingController::class, 'history'])->name('booking.history');
    Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');

    Route::get('/booking/{booking}/payment', [PaymentController::class, 'show'])->name('booking.payment');
    Route::post('/booking/{booking}/payment', [PaymentController::class, 'store'])->name('booking.payment.store');
    Route::get('/booking/{booking}/invoice', [PaymentController::class, 'invoice'])->name('booking.invoice');
});
