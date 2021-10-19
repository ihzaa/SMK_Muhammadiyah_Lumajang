<?php

use App\Http\Controllers\Front_User\LadingPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LadingPageController::class, 'index'])->name('landing-page');
// Route::get('/', function () {
//     return view('front-user.pages.landing_page');
// });
