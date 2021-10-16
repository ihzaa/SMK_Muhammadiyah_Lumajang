<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DeployController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Commands\CreatePermission;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('login', [LoginController::class, 'loginGet'])->name('login.get')->middleware(['guest']);
    Route::post('login', [LoginController::class, 'loginPost'])->name('login.post')->middleware(['guest']);

    Route::get('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
});

Route::get('deploy/kucingkucantikdanmanis', [DeployController::class, 'deploy']);

Route::get('permission/create/{permission_name}', function ($permission_name) {
    CreatePermission::create($permission_name);
    dd([
        'STATUS' => 'OK',
        'MESSAGE' => "Permission [$permission_name] has been created."
    ]);
});
