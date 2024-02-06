<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KweweController;
use App\Http\Controllers\APIAkreditasi\IndexController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/kegiatan-profesi/{idAsosiasi}', [IndexController::class, 'getKegiatanProfesi']);
});

Route::post('/token', [IndexController::class, 'generateToken']);

Route::get('/job-penilaian', KweweController::class);

Route::get('/kegiatan-badan-usaha/{idAsosiasi}', [IndexController::class, 'getKegiatanBU']);
Route::get('/detail-kegiatan/{idKegiatan}', [IndexController::class, 'getDetail']);
