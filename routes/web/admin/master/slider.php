<?php

use App\Http\Controllers\Admin\Master\SliderController;
use Illuminate\Support\Facades\Route;

$permission = 'slider';
Route::prefix('admin/master/slider')->name('admin.master.slider.')->middleware(['auth'])->group(function () use ($permission) {
    Route::middleware(['permission:view ' . $permission])->group(function () {
        Route::get('/', [SliderController::class, 'index'])->name('index');
        // Route::get('show/{id}', [SliderController::class, 'show'])->name('show');
    });

    Route::middleware(['permission:create ' . $permission])->group(function () {
        Route::get('create', [SliderController::class, 'create'])->name('create');
        Route::post('store', [SliderController::class, 'store'])->name('store');
    });

    Route::middleware(['permission:update ' . $permission])->group(function () {
        Route::get('edit/{id}', [SliderController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [SliderController::class, 'update'])->name('update');
    });

    Route::middleware(['permission:delete ' . $permission])->group(function () {
        Route::get('delete/{id}', [SliderController::class, 'delete'])->name('delete');
    });

    Route::middleware(['permission:restore ' . $permission])->group(function () {
        Route::get('restore/{id}', [SliderController::class, 'restore'])->name('restore');
    });
});
