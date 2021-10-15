<?php

use App\Http\Controllers\Admin\Master\FacilityController;
use Illuminate\Support\Facades\Route;

$permission = 'fasilitas';
Route::prefix('admin/master/facility')->name('admin.master.facility.')->middleware(['auth'])->group(function () use ($permission) {
    Route::middleware(['permission:view ' . $permission])->group(function () {
        Route::get('/', [FacilityController::class, 'index'])->name('index');
        // Route::get('show/{id}', [FacilityController::class, 'show'])->name('show');
    });

    Route::middleware(['permission:create ' . $permission])->group(function () {
        Route::get('create', [FacilityController::class, 'create'])->name('create');
        Route::post('store', [FacilityController::class, 'store'])->name('store');
    });

    Route::middleware(['permission:update ' . $permission])->group(function () {
        Route::get('edit/{id}', [FacilityController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [FacilityController::class, 'update'])->name('update');
    });

    Route::middleware(['permission:delete ' . $permission])->group(function () {
        Route::get('delete/{id}', [FacilityController::class, 'delete'])->name('delete');
    });

    Route::middleware(['permission:restore ' . $permission])->group(function () {
        Route::get('restore/{id}', [FacilityController::class, 'restore'])->name('restore');
    });
});
