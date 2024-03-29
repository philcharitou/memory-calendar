<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Auth;
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

Route::auth();
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'passwordLogin'])->name('login');

Route::get('/get-ajax', [App\Http\Controllers\EventController::class, 'getDate']);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/events', EventController::class);

