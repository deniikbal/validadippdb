<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [\App\Http\Controllers\StudentController::class, 'index'])->name('home');
Route::get('/validasi/{id}', [\App\Http\Controllers\StudentController::class, 'edit'])->name('validasi.edit');
Route::post('/update/{id}', [\App\Http\Controllers\StudentController::class, 'update'])->name('validasi.update');
Route::post('/validasi/{id}', [\App\Http\Controllers\StudentController::class, 'validasi'])->name('validasi');
Route::post('/unvalidasi/{id}', [\App\Http\Controllers\StudentController::class, 'unvalidasi'])->name('unvalidasi');
Route::post('/unverifikasi/{id}', [\App\Http\Controllers\StudentController::class, 'unverifikasi'])->name('unverifikasi');
