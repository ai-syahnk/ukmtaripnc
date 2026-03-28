<?php

use App\Http\Controllers\AuthController;
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
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/admin/tari', function () {
        return view('admin.tari');
    })->name('admin.tari');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::get('/booking', function () {
    return view('web.booking.main');
});

Route::get('/booking/create', function () {
    return view('web.booking.create');
});
