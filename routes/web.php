<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SSOController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LogBookController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\PerbaikanController;
use App\Http\Controllers\PreferensiController;
use App\Http\Controllers\OldKegiatanController;
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


//sso
Route::get('/pkb-siki-login', [SSOController::class, 'view'])->name('ska');
Route::post('/login-siki', [SSOController::class, 'login'])->name('login.sso');
Route::get('/pkb-simpan-login', [SSOController::class, 'loginSKK'])->name('skk');
Route::post('/login-simpan', [SSOController::class, 'skk'])->name('login.skk');

//index
Route::get('/', [IndexController::class, 'index']);

//testing
Route::get('/prototype', function(){
    return view('auth.form-jenis-penyelenggara.pemerintah');
});

//permohonan akun
Route::get('/permohonan-akun', [PermohonanAkunController::class, 'index'])->name('permohonan.akun');
Route::get('/permohonan-akun/detail', [PermohonanAkunController::class, 'form'])->name('form.akun');
Route::post('/permohonan-akun/save', [PermohonanAkunController::class, 'store'])->name('form.akun.save');
Route::get('/permohonan-akun/perbaikan/{uuid}', [PermohonanAkunController::class, 'edit'])->name('form.perbaikan');

Route::middleware(['auth'])->group(function () {
    //admin
    Route::resource('roles', RoleController::class)->except('show');
    Route::resource('users', UserController::class)->only(['index']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/list-permohonan', [VerifikasiAkunController::class, 'list'])->name('list.permohonan');
    Route::get('/detail-permohonan/{uuid}', [VerifikasiAkunController::class, 'detailPermohonan'])->name('detail.permohonan');
    Route::post('/permohonan-tolak/{uuid}', [VerifikasiAkunController::class, 'tolakPermohonan'])->name('permohonan.tolak');
    Route::post('/permohonan-perbaikan/{uuid}', [VerifikasiAkunController::class, 'perbaikanPermohonan'])->name('permohonan.perbaikan');
    Route::get('/permohonan-approve/{uuid}', [VerifikasiAkunController::class, 'approvePermohonan'])->name('permohonan.approve');
    Route::get('/list-verifikasi', [VerifikasiKegiatanController::class, 'list'])->name('list.kegiatan');
    Route::get('/detail-verifikasi/{uuid}', [VerifikasiKegiatanController::class, 'detail'])->name('verifikasi.kegiatan');
    Route::get('/detail/{id}', [VerifikasiKegiatanController::class, 'detailKegiatan']);
    Route::put('/kegiatan/hasil', [VerifikasiKegiatanController::class, 'updateStatus'])->name('verifikasi.status');
    Route::post('/add-komen', [VerifikasiKegiatanController::class, 'addKomen'])->name('add.komen');

    //penyelenggara
    Route::resource('kegiatan-penyelenggara', KegiatanController::class);
    Route::get('/kegiatan/submit/{uuid}', [KegiatanController::class, 'submit'])->name('submit.kegiatan');
    Route::get('/kegiatan/terverifikasi', [KegiatanController::class, 'setuju'])->name('kegiatan.setuju');
    Route::get('/kegiatan/tolak', [KegiatanController::class, 'tolak'])->name('kegiatan.tolak');

    Route::get('/surat/{uuid}', [PerbaikanController::class, 'surat'])->name('edit.surat');
    Route::get('/tor-kak/{uuid}', [PerbaikanController::class, 'tor'])->name('edit.tor');
    Route::get('/cv/{uuid}', [PerbaikanController::class, 'cv'])->name('edit.cv');
    Route::get('/sk-panitia/{uuid}', [PerbaikanController::class, 'sk'])->name('edit.sk');
    Route::get('/persyaratan-lain/{uuid}', [PerbaikanController::class, 'lain1'])->name('edit.lain1');
    Route::get('/lainnya/{uuid}', [PerbaikanController::class, 'lain2'])->name('edit.lain2');

    Route::put('/surat-update/{id}', [PerbaikanController::class, 'updateSurat'])->name('update.surat');
    Route::put('/tor-update/{id}', [PerbaikanController::class, 'updateTor'])->name('update.tor');
    Route::put('/cv-update/{id}', [PerbaikanController::class, 'updateCV'])->name('update.cv');
    Route::put('/sk-update/{id}', [PerbaikanController::class, 'updateSK'])->name('update.sk');
    Route::put('/lain1-update/{id}', [PerbaikanController::class, 'updateLain1'])->name('update.lain1');
    Route::put('/lain2-update/{id}', [PerbaikanController::class, 'updateLain2'])->name('update.lain2');

    Route::resource('/pelaporan', PelaporanController::class)->only(['store', 'edit', 'update']);
    Route::get('/pelaporan/submit/{id}', [PelaporanController::class, 'submit'])->name('pelaporan.submit');

    Route::resource('/sub-penyelenggara', SubPenyelenggaraController::class)->except('show');
    Route::get('/sub-penyelenggara/change-status/{id}', [SubPenyelenggaraController::class, 'change'])->name('change.status');
    Route::get('/peserta-kegiatan/create/{uuid}', [PesertaKegiatanController::class, 'create'])->name('peserta.create');
    Route::post('/peserta-kegiatan', [PesertaKegiatanController::class, 'store'])->name('peserta.store');
    Route::resource('/peserta', PesertaKegiatanController::class)->only(['edit', 'update']);
    // Route::post('/mark-as-read', [PreferensiController::class, 'markNotif'])->name('markNotification');

    //tenaga ahli
    Route::get('/daftar-kegiatan', [LogBookController::class, 'index'])->name('logbook.index');
    Route::get('/kegiatan-tidak-terverifikasi', [LogBookController::class, 'unverified'])->name('kegiatan.unverified');
    Route::post('/unverified', [LogBookController::class, 'store'])->name('unverified.store');
    Route::resource('/kegiatan-terdaftar', OldKegiatanController::class)->only(['create', 'store']);
});

//referensi
Route::get('/kab-kota', [PreferensiController::class, 'getKabKota']);
Route::get('/detail-asosiasi-profesi', [PreferensiController::class, 'getAsosiasiProfesi']);
Route::get('/detail-asosiasi-bu', [PreferensiController::class, 'getAsosiasiBU']);
Route::get('/detail-instansi/{id}', [PreferensiController::class, 'showInstansi']);

require __DIR__.'/auth.php';
