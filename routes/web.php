<?php

use Illuminate\Support\Facades\Route;
// FrontEnd
use App\Http\Controllers\HomeController;

// BackEnd
use App\Http\Controllers\Auth\AuthController;

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
Route::get('/', [HomeController::class, 'index'])->name('home');


Route::prefix('auth')->middleware('guest')->group(function(){
    Route::get('', [AuthController::class, 'index'])->name('auth');
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
});