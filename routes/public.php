<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register')
    ->middleware('guest');
Route::post('/register/store', [RegisteredUserController::class, 'store'])->name('register.store')
    ->middleware('guest');

Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login')->middleware('guest');
Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login.store')->middleware('guest');
