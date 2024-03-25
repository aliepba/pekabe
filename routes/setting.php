<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Setting\RoleMenuController;

Route::middleware(['auth'])->group(function(){

    Route::group(['prefix' => 'setting', 'as' => 'setting.'], function(){
        
        Route::group(['prefix' => 'role-menu', 'as' => 'role-menu.'], function(){
            Route::get('/', [RoleMenuController::class, 'index'])->name('list');
            Route::get('create', [RoleMenuController::class, 'create'])->name('create');
            Route::post('store', [RoleMenuController::class, 'store'])->name('store');
            Route::get('edit/{id}', [RoleMenuController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [RoleMenuController::class, 'update'])->name('update');
            Route::post('delete/{id}', [RoleMenuController::class, 'delete'])->name('delete');
        });
    });
});