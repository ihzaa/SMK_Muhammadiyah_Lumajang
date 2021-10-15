<?php

use App\Http\Controllers\Admin\Master\NewsController;
use Illuminate\Support\Facades\Route;

$permission = 'berita';
Route::prefix('admin/master/news')->name('admin.master.news.')->middleware(['auth'])->group(function () use ($permission) {
    Route::middleware(['permission:view ' . $permission])->group(function () {
        Route::get('/', [NewsController::class, 'index'])->name('index');
        // Route::get('show/{id}', [NewsController::class, 'show'])->name('show');
    });

    Route::middleware(['permission:create ' . $permission])->group(function () {
        Route::get('create', [NewsController::class, 'create'])->name('create');
        Route::post('store', [NewsController::class, 'store'])->name('store');
    });

    Route::middleware(['permission:update ' . $permission])->group(function () {
        Route::get('edit/{id}', [NewsController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [NewsController::class, 'update'])->name('update');
    });

    Route::middleware(['permission:delete ' . $permission])->group(function () {
        Route::get('delete/{id}', [NewsController::class, 'delete'])->name('delete');
    });

    Route::middleware(['permission:restore ' . $permission])->group(function () {
        Route::get('restore/{id}', [NewsController::class, 'restore'])->name('restore');
    });
});
