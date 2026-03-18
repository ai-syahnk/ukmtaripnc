<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/beranda', function () {
    return view('web.beranda');
});

Route::get('/login', function () {
    return view('web.login');
});

Route::get('/register', function () {
    return view('web.register');
});