<?php

use App\Http\Controllers\Front_User\AboutUsController;
use Illuminate\Support\Facades\Route;

Route::prefix('Tentang-Kami')->name('front-user.about-us.')->group(function () {
    Route::get('/', [AboutUsController::class, 'index'])->name('index');
});
