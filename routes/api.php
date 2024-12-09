<?php

use App\Http\Controllers\Api\StepController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/get-step-data', [StepController::class, 'getStepData'])->name('item.step.data');
