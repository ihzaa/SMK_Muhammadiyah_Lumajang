<?php

use App\Http\Controllers\Admin\UserConfig\PermissionController;
use Illuminate\Support\Facades\Route;

const permission_permission = 'permission';

Route::prefix('admin/user_config')->name('admin.user_config.')->group(function () {
    Route::prefix('permission')->name('permission.')->group(function () {
        Route::middleware(['permission:view ' . permission_permission])->group(function () {
            Route::get('/', [PermissionController::class, 'index'])->name('index');
            Route::get('show/{id}', [PermissionController::class, 'show'])->name('show');
        });
        Route::middleware(['permission:edit ' . permission_permission])->group(function () {
            Route::post('update/{id}', [PermissionController::class, 'update'])->name('update');
        });
        Route::middleware(['permission:delete ' . permission_permission])->group(function () {
            Route::get('delete/{id}', [PermissionController::class, 'delete'])->name('delete');
        });
        Route::middleware(['permission:create ' . permission_permission])->group(function () {
            Route::get('create', [PermissionController::class, 'createGet'])->name('createGet');
            Route::post('create', [PermissionController::class, 'createPost'])->name('createPost');
        });
    });

});
