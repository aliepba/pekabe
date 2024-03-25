<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ErrorController;

Route::get('error', [ErrorController::class, 'index'])->name('error.page');
Route::get('list-error', [ErrorController::class, 'list'])->name('error.list');