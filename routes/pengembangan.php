<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Pengembangan\AccountController;

Route::post('/akun-api/{id}', [AccountController::class, 'create'])->name('user.api');