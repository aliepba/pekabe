<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UnsurKegiatanController;
use App\Http\Controllers\BobotPenilaianController;
use App\Http\Controllers\SubUnsurKegiatanController;
use App\Http\Controllers\SettingsController;

Route::middleware(['auth'])->group(function () {
    //master
    Route::resource('roles', RoleController::class)->except('show');
    Route::resource('users', UserController::class)->except('show');
    Route::resource('unsur-kegiatan', UnsurKegiatanController::class);
    Route::resource('bobot-penilaian', BobotPenilaianController::class);
    Route::resource('sub-unsur-kegiatan', SubUnsurKegiatanController::class);

    //setting
    Route::get('/settings', [SettingsController::class, 'index'])->name('setting.pelaporan');
    Route::get('/change-status-setting', [SettingsController::class, 'statusPelaporan'])->name('setting.update');
    Route::get('/change-status-kegiatan', [SettingsController::class, 'pengajuanKegiatan'])->name('setting.kegiatan');
});