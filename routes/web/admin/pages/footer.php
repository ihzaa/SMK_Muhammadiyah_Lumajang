<?php

use App\Http\Controllers\Admin\Pages\FooterController;
use Illuminate\Support\Facades\Route;

$permission = 'footer';
Route::prefix('admin/pages/footer')->name('admin.pages.footer.')->middleware(['auth'])->group(function () use ($permission) {
    Route::middleware(['permission:view ' . $permission])->group(function () {
        Route::get('/', [FooterController::class, 'index'])->name('index');
    });

    Route::middleware(['permission:update ' . $permission])->group(function () {
        Route::post('update', [FooterController::class, 'update'])->name('update');
    });
});
