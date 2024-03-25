<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KweweController;
use App\Http\Controllers\APIAkreditasi\IndexController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ActivityController;
use App\Http\Controllers\API\LogbookController;

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
    Route::get('/list-kegiatan', [ActivityController::class, 'listKegiatan']);
    Route::get('/list-logbook', [LogbookController::class, 'list']);
});

Route::post('/token', [IndexController::class, 'generateToken']);

Route::post('/login-ska', [AuthController::class, 'ska']);
Route::post('/login-skk', [AuthController::class, 'skk']);

Route::get('/job-penilaian', KweweController::class);

Route::get('/kegiatan-badan-usaha/{idAsosiasi}', [IndexController::class, 'getKegiatanBU']);
Route::get('/detail-kegiatan/{idKegiatan}', [IndexController::class, 'getDetail']);
