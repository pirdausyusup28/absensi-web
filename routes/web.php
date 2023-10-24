<?php

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



Auth::routes();

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/downloadexcel', [App\Http\Controllers\HomeController::class, 'downloadexcel'])->name('downloadexcel');
Route::get('/kehadiran', [App\Http\Controllers\HomeController::class, 'kehadiran'])->name('kehadiran');
Route::post('/checkin', [App\Http\Controllers\HomeController::class, 'checkin'])->name('checkin');
Route::post('/checkout', [App\Http\Controllers\HomeController::class, 'checkout'])->name('checkout');
