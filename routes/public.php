<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormAbsenController;

Route::get('/form-absen-kegiatan/{uuid}', [FormAbsenController::class, 'index'])->name('absen.peserta');
