<?php

use App\Actions\Kegiatan\GetKegiatanSetuju;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SSOController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Pkbv1Controller;
use App\Http\Controllers\LogBookController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\PerbaikanController;
use App\Http\Controllers\PengesahanController;
use App\Http\Controllers\OldKegiatanController;
use App\Http\Controllers\UploadPesertaController;
use App\Http\Controllers\PermohonanAkunController;
use App\Http\Controllers\VerifikasiAkunController;
use App\Http\Controllers\PesertaKegiatanController;
use App\Http\Controllers\SubPenyelenggaraController;
use App\Http\Controllers\PenilaianKegiatanController;
use App\Http\Controllers\VerifikasiKegiatanController;
use App\Http\Controllers\PenilaianValidatorController;
use App\Http\Controllers\Pengembangan\KegiatanController as PengembanganController;
use App\Http\Controllers\Pengembangan\AsosiasiController;
use App\Http\Controllers\KegiatanSahController;
use App\Http\Controllers\IndikatorController;
use App\Http\Controllers\RollbackController;
use App\Http\Controllers\SiJKTController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/sijkt', [SiJKTController::class, 'sijkt'])->name('sijkt');
Route::get('/sijkt-proses', [SiJKTController::class, 'proses'])->name('sijkt.proses');
Route::get('/login-siki-simpan/{id}/{token}', [SiJKTController::class, 'login'])->name('sijkt.siki');
Route::post('/connect-sijkt', [SiJKTController::class, 'connect'])->name('sijkt.connect');

//index
Route::get('/', [IndexController::class, 'index'])->name('indexing');

//testing
Route::get('/prototype', function(){
    return view('auth.form-jenis-penyelenggara.pemerintah');
});

//permohonan akun
Route::get('/permohonan-akun', [PermohonanAkunController::class, 'index'])->name('permohonan.akun');
Route::get('/permohonan-akun/detail', [PermohonanAkunController::class, 'form'])->name('form.akun');
Route::post('/permohonan-akun/save', [PermohonanAkunController::class, 'store'])->name('form.akun.save');
Route::get('/permohonan-akun/perbaikan/{uuid}', [PermohonanAkunController::class, 'edit'])->name('form.perbaikan');
Route::put('/permohonan-akun/update/{uuid}', [PermohonanAkunController::class, 'update'])->name('form.update.perbaikan');

Route::get('/dashboard-tenaga-ahli', [DashboardController::class, 'dashboardTenagaAhli'])->name('dashboard.tenaga.ahli');
Route::get('/home', [DashboardController::class, 'indexSKK'])->name('index.skk');

Route::get('/daftar-kegiatan-disetujui', function(){
    return view('daftar-kegiatan', GetKegiatanSetuju::run());
})->name('kegiatan.setujui');

Route::prefix('/pengembangan')->middleware(['auth'])->group(function (){
    Route::get('/kegiatan', [PengembanganController::class, 'index'])->name('pengembangan.index');
    Route::get('/detail-kegiatan/{uuid}', [PengembanganController::class, 'detail'])->name('pengembangan.detail');
    Route::put('/pengesahan/{uuid}', [PengembanganController::class, 'pengesahan'])->name('pengembangan.sah');

    Route::get('/asosiasi/kegiatan', [AsosiasiController::class, 'index'])->name('asosiasi.index');
    Route::get('/asosiasi/kegiatan-detail/{uuid}', [AsosiasiController::class, 'detail'])->name('asosiasi.detail');
    Route::get('/detail-api/{uuid}', [AsosiasiController::class, 'detailApi']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('profile-pkb', [IndikatorController::class, 'index'])->name('profile.index');
    Route::get('profile-pkb-khusus', [IndikatorController::class, 'khusus'])->name('profile.khusus');
    Route::get('rollback-kegiatan', [RollbackController::class, 'index'])->name('rollback');
    Route::post('rollback-proses', [RollbackController::class, 'process'])->name('rollback.proses');
    
    Route::get('open-pelaporan', [RollbackController::class, 'openPelaporan'])->name('rollback.pelaporan');
    Route::post('open-proses', [RollbackController::class, 'prosesPelaporan'])->name('rollback.pelaporan.proses');
    //admin
    Route::resource('verifikasi-validasi', PenilaianValidatorController::class)->only(['index', 'show']);
    Route::put('/verifikasi-validasi/{uuid}', [PenilaianValidatorController::class, 'validasi'])->name('validasi.kegiatan');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/list-permohonan', [VerifikasiAkunController::class, 'list'])->name('list.permohonan');
    Route::get('/detail-permohonan/{uuid}', [VerifikasiAkunController::class, 'detailPermohonan'])->name('detail.permohonan');
    Route::post('/permohonan-tolak/{uuid}', [VerifikasiAkunController::class, 'tolakPermohonan'])->name('permohonan.tolak');
    Route::post('/permohonan-perbaikan/{uuid}', [VerifikasiAkunController::class, 'perbaikanPermohonan'])->name('permohonan.perbaikan');
    Route::get('/permohonan-approve/{uuid}', [VerifikasiAkunController::class, 'approvePermohonan'])->name('permohonan.approve');
    Route::get('/akun-setujui', [VerifikasiAkunController::class, 'setuju'])->name('akun.setuju');
    Route::get('/akun-tolak', [VerifikasiAkunController::class, 'tolak'])->name('akun.tolak');
    Route::get('/list-verifikasi', [VerifikasiKegiatanController::class, 'list'])->name('list.kegiatan');
    Route::get('/detail-verifikasi/{uuid}', [VerifikasiKegiatanController::class, 'detail'])->name('verifikasi.kegiatan');
    Route::get('/kegiatan-setuju', [VerifikasiKegiatanController::class, 'setuju'])->name('setuju.kegiatan');
    Route::get('/kegiatan-tolak', [VerifikasiKegiatanController::class, 'tolak'])->name('tolak.kegiatan');
    Route::get('/detail/{id}', [VerifikasiKegiatanController::class, 'detailKegiatan']);
    Route::put('/kegiatan/hasil', [VerifikasiKegiatanController::class, 'updateStatus'])->name('verifikasi.status');
    Route::post('/add-komen', [VerifikasiKegiatanController::class, 'addKomen'])->name('add.komen');
    Route::get('/penilaian-kegiatan', [PenilaianKegiatanController::class, 'index'])->name('penilaian.index');
    Route::get('/penilaian-kegiatan/{uuid}', [PenilaianKegiatanController::class, 'detail'])->name('penilaian.detail');
    Route::post('/save-penilaian', [PenilaianKegiatanController::class, 'store'])->name('penilaian.store');
    Route::get('/pengesahan-kegiatan', [PengesahanController::class, 'index'])->name('pengesahan.index');
    Route::get('/detail-pengesahan/{uuid}', [PengesahanController::class, 'detail'])->name('pengesahan.detail');
    Route::put('/pengesahan/{uuid}', [PengesahanController::class, 'sah'])->name('pengesahan.selesai');
    Route::get('/berita-acara-pengesahan/{uuid}', [PengesahanController::class, 'ba'])->name('pengesahan.ba');

    Route::get('/kegiatan-sah', [KegiatanSahController::class, 'index'])->name('kegiatan.sah');
    Route::get('/kegiatan-sah-detail/{uuid}', [KegiatanSahController::class, 'detail'])->name('kegiatan.sah.detail');

    Route::get('/upload-excel/{uuid}', [UploadPesertaController::class, 'index'])->name('excel');
    Route::post('/import-excel/{uuid}', [UploadPesertaController::class, 'import'])->name('excel.import');
    Route::get('/excel-peserta/edit/{id}', [UploadPesertaController::class, 'edit'])->name('excel.edit');
    Route::put('/excel-peserta/{id}/{uuid}', [UploadPesertaController::class, 'update'])->name('excel.update');
    Route::get('/excel-peserta/accept/{id}/{uuid}', [UploadPesertaController::class, 'acc'])->name('excel.acc');
    Route::delete('/excel-peserta/delete/{id}/{uuid}', [UploadPesertaController::class, 'destroy'])->name('excel.destroy');
    Route::get('/detail-peserta/{id}', [UploadPesertaController::class, 'show'])->name('detail.peserta.excel');
    Route::put('/peserta-updated/{id}', [UploadPesertaController::class, 'updated'])->name('detail.peserta.updated');
    Route::get('/data-excel/{uuid}', [UploadPesertaController::class, 'data'])->name('data.excel');

    //export excel
    Route::get('/export-kegiatan', [VerifikasiKegiatanController::class, 'export'])->name('export.kegiatan');

    //setting

    //penyelenggara
    Route::get('/dashboard-user', [DashboardController::class, 'dashboardUser'])->name('dashboard.user');
    Route::resource('kegiatan-penyelenggara', KegiatanController::class);
    Route::get('/kegiatan/submit/{uuid}', [KegiatanController::class, 'submit'])->name('submit.kegiatan');
    Route::get('/kegiatan/setujui', [KegiatanController::class, 'setuju'])->name('kegiatan.setuju');
    Route::get('/kegiatan/tolak', [KegiatanController::class, 'tolak'])->name('kegiatan.tolak');

    Route::get('/surat/{uuid}', [PerbaikanController::class, 'surat'])->name('edit.surat');
    Route::get('/tor-kak/{uuid}', [PerbaikanController::class, 'tor'])->name('edit.tor');
    Route::get('/cv/{uuid}', [PerbaikanController::class, 'cv'])->name('edit.cv');
    Route::get('/sk-panitia/{uuid}', [PerbaikanController::class, 'sk'])->name('edit.sk');
    Route::get('/persyaratan-lain/{uuid}', [PerbaikanController::class, 'lain1'])->name('edit.lain1');
    Route::get('/lainnya/{uuid}', [PerbaikanController::class, 'lain2'])->name('edit.lain2');

    Route::put('/surat-update/{id}', [PerbaikanController::class, 'updateSurat'])->name('surat.update');
    Route::put('/tor-update/{id}', [PerbaikanController::class, 'updateTor'])->name('tor.update');
    Route::put('/cv-update/{id}', [PerbaikanController::class, 'updateCV'])->name('cv.update');
    Route::put('/sk-update/{id}', [PerbaikanController::class, 'updateSK'])->name('sk.update');
    Route::put('/lain1-update/{id}', [PerbaikanController::class, 'updateLain1'])->name('lain1.update');
    Route::put('/lain2-update/{id}', [PerbaikanController::class, 'updateLain2'])->name('lain2.update');

    Route::resource('/pelaporan', PelaporanController::class)->only(['store', 'edit', 'update']);
    Route::get('/pelaporan/submit/{id}', [PelaporanController::class, 'submit'])->name('pelaporan.submit');

    Route::resource('/sub-penyelenggara', SubPenyelenggaraController::class)->except('show');
    Route::get('/sub-penyelenggara/change-status/{id}', [SubPenyelenggaraController::class, 'change'])->name('change.status');
    Route::get('/peserta-kegiatan/create/{uuid}', [PesertaKegiatanController::class, 'create'])->name('peserta.create');
    Route::post('/peserta-kegiatan', [PesertaKegiatanController::class, 'store'])->name('peserta.store');
    Route::resource('/peserta', PesertaKegiatanController::class)->only(['edit', 'update', 'destroy']);
    Route::put('/peserta-update/{id}/{kegiatan?}', [PesertaKegiatanController::class, 'updateValidasi'])->name('peserta.validasi');

    Route::post('/add-peserta', [PesertaKegiatanController::class, 'addPeserta'])->name('peserta.add');
    Route::get('/get-peserta/{id}', [PesertaKegiatanController::class, 'getPeserta'])->name('peserta.get');
    Route::delete('/hapus-peserta/{id}', [PesertaKegiatanController::class, 'deletePeserta'])->name('peserta.hapus');

    Route::get('kegiatan-pkb-terverifikasi', [Pkbv1Controller::class, 'kegiatanTerverifikasi'])->name('pkb.lama');

    //tenaga ahli
    Route::get('/daftar-kegiatan', [LogBookController::class, 'index'])->name('logbook.index');
    Route::get('/kegiatan-tidak-terverifikasi', [LogBookController::class, 'unverified'])->name('kegiatan.unverified');
    Route::get('/kegiatan-tidak-terverifikasi/{id}', [LogBookController::class, 'edit'])->name('unverified.edit');
    Route::put('/kegiatan-unverified/update/{id}', [LogBookController::class, 'update'])->name('unverified.update');
    Route::post('/unverified', [LogBookController::class, 'store'])->name('unverified.store');
    Route::delete('/unverified-delete/{id}', [LogBookController::class, 'delete'])->name('unverified.delete');
    Route::resource('/kegiatan-terdaftar', OldKegiatanController::class)->only(['create', 'store']);
    Route::get('/kegiatan-skpk', [LogBookController::class, 'listSkpk'])->name('kegiatan.skpk');
    Route::get('/summary-spkp/{sub}', [LogBookController::class, 'export'])->name('summary');

    //aptdada
    Route::get('/dashboard-apt', [DashboardController::class, 'dashboardApt'])->name('dashboard.apt');
    Route::get('/list-verifikasi-apt', [VerifikasiKegiatanController::class, 'apt'])->name('verifikasi.apt');
    Route::get('/list-validasi-apt', [PenilaianValidatorController::class, 'apt'])->name('validator.apt');
    
});

//referensi
require __DIR__.'/auth.php';
