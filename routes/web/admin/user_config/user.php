<?php

use App\Http\Controllers\Admin\UserConfig\UserController;
use Illuminate\Support\Facades\Route;


$permission = 'users';
Route::prefix('admin/user_config/user')->name('admin.user_config.user.')->group(function () use ($permission) {
    Route::middleware(['permission:view ' . $permission])->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('show/{id}', [UserController::class, 'show'])->name('show');
    });
    Route::middleware(['permission:create ' . $permission])->group(function () {
        Route::get('create', [UserController::class, 'createGet'])->name('createGet');
        Route::post('create', [UserController::class, 'createPost'])->name('createPost');
    });
    Route::middleware(['permission:update ' . $permission])->group(function () {
        Route::post('update/{id}', [UserController::class, 'update'])->name('update');
    });
    Route::middleware(['permission:delete ' . $permission])->group(function () {
        Route::get('delete/{id}', [UserController::class, 'delete'])->name('delete');
    });
    Route::middleware(['permission:restore ' . $permission])->group(function () {
        Route::get('restore/{id}', [UserController::class, 'restore'])->name('restore');
    });
});
