<?php

use Illuminate\Support\Facades\Route;
// FrontEnd
use App\Http\Controllers\HomeController;

// BackEnd
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;

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
/* Frontend */
Route::get('/', [HomeController::class, 'index'])->name('home');

/* Backend */
Route::prefix('auth')->middleware('guest')->group(function(){
    Route::get('/', [AuthController::class, 'index'])->name('auth');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
});

Route::prefix('administrator')->middleware('auth')->group(function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('users')->middleware('can:read-users')->group(function(){
        Route::get('', [UserController::class, 'index'])->name('admin.users');
    });
});