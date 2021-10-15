<?php

use App\Http\Controllers\Admin\Master\AnnouncementController;
use Illuminate\Support\Facades\Route;

$permission = 'pengumuman';
Route::prefix('admin/master/announcement')->name('admin.master.announcement.')->middleware(['auth'])->group(function () use ($permission) {
    Route::middleware(['permission:view ' . $permission])->group(function () {
        Route::get('/', [AnnouncementController::class, 'index'])->name('index');
        // Route::get('show/{id}', [SliderController::class, 'show'])->name('show');
    });

    Route::middleware(['permission:create ' . $permission])->group(function () {
        Route::get('create', [AnnouncementController::class, 'create'])->name('create');
        Route::post('store', [AnnouncementController::class, 'store'])->name('store');
    });

    Route::middleware(['permission:update ' . $permission])->group(function () {
        Route::get('edit/{id}', [AnnouncementController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [AnnouncementController::class, 'update'])->name('update');
    });

    Route::middleware(['permission:delete ' . $permission])->group(function () {
        Route::get('delete/{id}', [AnnouncementController::class, 'delete'])->name('delete');
    });

    Route::middleware(['permission:restore ' . $permission])->group(function () {
        Route::get('restore/{id}', [AnnouncementController::class, 'restore'])->name('restore');
    });
});
