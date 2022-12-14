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

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();
//Route::get('/portal/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('Employee Login');

Route::get('portal/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);
Route::post('portal/login', [App\Http\Controllers\Auth\LoginController::class, 'CustomLogin']);
Route::post('portal/logout', [App\Http\Controllers\Auth\LoginController::class, 'CustomLogout']);



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
