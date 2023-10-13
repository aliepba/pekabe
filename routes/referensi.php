<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PreferensiController;

Route::get('/kab-kota', [PreferensiController::class, 'getKabKota']);
Route::get('/get-validator', [PreferensiController::class, 'validator']);
Route::get('/detail-asosiasi-bu', [PreferensiController::class, 'getAsosiasiBU']);
Route::get('/get-unsur-kegiatan', [PreferensiController::class, 'unsurKegiatan']);
Route::get('/detail-instansi/{id}', [PreferensiController::class, 'showInstansi']);
Route::get('/get-sertifikat/{nik}', [PreferensiController::class, 'getSertifikat']);
Route::get('/detail-asosiasi-profesi', [PreferensiController::class, 'getAsosiasiProfesi']);
Route::post('/mark-as-read', [PreferensiController::class, 'markNotif'])->name('markNotification');
