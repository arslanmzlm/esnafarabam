<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return to_route('admin.dashboard');
})->name('dashboard');

require __DIR__ . '/admin.php';
require __DIR__ . '/auth.php';
