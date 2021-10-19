<?php

use App\Http\Controllers\Front_User\LadingPageController;
use App\Http\Controllers\Front_User\NewsController;
use Illuminate\Support\Facades\Route;

Route::prefix('berita')->name('front-user.news.')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('{title}/{id}', [NewsController::class, 'show'])->name('show');
});
