<?php

use App\Http\Controllers\Public\DefaultController;
use App\Http\Controllers\Public\ItemController;
use App\Http\Controllers\Public\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DefaultController::class, 'index'])->name('homepage');
Route::get('/ilan/{item}/{slug?}', [ItemController::class, 'detail'])->name('item.detail');
Route::get('/ikinci-el', [ItemController::class, 'search'])->name('item.search');
Route::get('/ikinci-el/{vehicleType:slug}', [ItemController::class, 'list'])->name('item.list');
Route::get('/hesabim', [UserController::class, 'profile'])->name('user.profile');
Route::post('/hesabim/kullanici', [UserController::class, 'updateUser'])->name('user.update');
Route::post('/hesabim/sifre', [UserController::class, 'updatePassword'])->name('user.password.update');
Route::post('/hesabim/profil', [UserController::class, 'updateProfile'])->name('user.profile.update');

Route::get('/{page:slug}', [DefaultController::class, 'page'])->name('page.detail');
