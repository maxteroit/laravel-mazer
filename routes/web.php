<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IntroController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::group(['middleware' => ['login']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/intro', IntroController::class, [
        'names' => [
            'index' => 'intro',
            'create' => 'intro.create',
            'store' => 'intro.store',
            'show' => 'intro.show',
            'edit' => 'intro.edit',
            'update' => 'intro.update',
            'destroy' => 'intro.destroy',
        ]
    ]);
});
