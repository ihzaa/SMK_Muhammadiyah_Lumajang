<?php

use App\Http\Controllers\Admin\Pages\AboutUsController;
use Illuminate\Support\Facades\Route;

$permission = 'about_us';
Route::prefix('admin/pages/about-us')->name('admin.pages.about-us.')->middleware(['auth'])->group(function () use ($permission) {
    Route::middleware(['permission:view ' . $permission])->group(function () {
        Route::get('/', [AboutUsController::class, 'index'])->name('index');
    });

    Route::middleware(['permission:update ' . $permission])->group(function () {
        Route::post('update', [AboutUsController::class, 'update'])->name('update');
    });
});
