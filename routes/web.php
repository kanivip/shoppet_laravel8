<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;

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
    return view('pages.index');
})->name('index');
    Route::get('/login',[userController::class, 'showLogin'])->name('login');
    Route::get('/register',[userController::class, 'showRegister'])->name('register');
    Route::post('/doRegister',[userController::class, 'doRegister'])->name('doRegister');