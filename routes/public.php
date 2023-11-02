<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormAbsenController;

Route::get('/form-absen-kegiatan/{uuid}', [FormAbsenController::class, 'index'])->name('absen.peserta');
Route::post('/absen-store', [FormAbsenController::class, 'store'])->name('absen.store');
Route::get('/success-absen', [FormAbsenController::class, 'success'])->name('absen.success');