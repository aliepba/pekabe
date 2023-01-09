<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SSOController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PreferensiController;
use App\Http\Controllers\PermohonanAkunController;
use App\Http\Controllers\VerifikasiAkunController;
use App\Http\controllers\PesertaKegiatanController;
use App\Http\Controllers\SubPenyelenggaraController;
use App\Http\Controllers\VerifikasiKegiatanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/pkb-simpan-login', [SSOController::class, 'view'])->name('sso');
Route::post('/testing', [SSOController::class, 'login'])->name('login.sso');

Route::get('/', [IndexController::class, 'index']);

Route::get('/prototype', function(){
    return view('auth.form-jenis-penyelenggara.pemerintah');
});

Route::get('/permohonan-akun', [PermohonanAkunController::class, 'index'])->name('permohonan.akun');
Route::get('/permohonan-akun/detail', [PermohonanAkunController::class, 'form'])->name('form.akun');
Route::post('/permohonan-akun/save', [PermohonanAkunController::class, 'store'])->name('form.akun.save');
Route::get('/permohonan-akun/perbaikan/{uuid}', [PermohonanAkunController::class, 'edit'])->name('form.perbaikan');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/list-permohonan', [VerifikasiAkunController::class, 'list'])->name('list.permohonan');
    Route::get('/detail-permohonan/{uuid}', [VerifikasiAkunController::class, 'detailPermohonan'])->name('detail.permohonan');
    Route::post('/permohonan-tolak/{uuid}', [VerifikasiAkunController::class, 'tolakPermohonan'])->name('permohonan.tolak');
    Route::post('/permohonan-perbaikan/{uuid}', [VerifikasiAkunController::class, 'perbaikanPermohonan'])->name('permohonan.perbaikan');
    Route::get('/permohonan-approve/{uuid}', [VerifikasiAkunController::class, 'approvePermohonan'])->name('permohonan.approve');
    Route::resource('/sub-penyelenggara', SubPenyelenggaraController::class)->except('show');
    Route::get('/sub-penyelenggara/change-status/{id}', [SubPenyelenggaraController::class, 'change'])->name('change.status');
    Route::resource('roles', RoleController::class)->except('show');
    Route::resource('users', UserController::class)->only(['index']);
    Route::resource('kegiatan-penyelenggara', KegiatanController::class);
    Route::get('/list-verifikasi', [VerifikasiKegiatanController::class, 'list'])->name('list.kegiatan');
    Route::get('/detail-verifikasi/{uuid}', [VerifikasiKegiatanController::class, 'detail'])->name('verifikasi.kegiatan');
    Route::get('/peserta-kegiatan/create', [PesertaKegiatanController::class])->name('peserta.create');
});


Route::get('/kab-kota', [PreferensiController::class, 'getKabKota']);
Route::get('/detail-asosiasi-profesi', [PreferensiController::class, 'getAsosiasiProfesi']);
Route::get('/detail-asosiasi-bu', [PreferensiController::class, 'getAsosiasiBU']);
Route::get('/detail-instansi/{id}', [PreferensiController::class, 'showInstansi']);

require __DIR__.'/auth.php';
