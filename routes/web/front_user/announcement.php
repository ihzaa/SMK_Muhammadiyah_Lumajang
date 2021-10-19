<?php

use App\Http\Controllers\Front_User\AnnouncementController;
use Illuminate\Support\Facades\Route;

Route::prefix('pengumuman')->name('front-user.announcement.')->group(function () {
    Route::get('/', [AnnouncementController::class, 'index'])->name('index');
    Route::get('show/{title}/{id}', [AnnouncementController::class, 'show'])->name('show');
});
