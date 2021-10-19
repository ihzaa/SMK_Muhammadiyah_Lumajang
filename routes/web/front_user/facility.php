<?php

use App\Http\Controllers\Front_User\FacilityController;
use Illuminate\Support\Facades\Route;

Route::prefix('fasilitas')->name('front-user.facility.')->group(function () {
    Route::get('/', [FacilityController::class, 'index'])->name('index');
    Route::get('{title}/{id}', [FacilityController::class, 'show'])->name('show');
});
