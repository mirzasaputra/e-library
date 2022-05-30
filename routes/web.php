<?php

use Illuminate\Support\Facades\Route;
// FrontEnd
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\KatalogController;

// BackEnd
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Book\BookController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\User\UserController;

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
Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog');
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact');

/* Backend */
Route::prefix('auth')->middleware('guest')->group(function(){
    Route::get('/', [AuthController::class, 'index'])->name('auth');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
});
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::prefix('administrator')->middleware('auth')->group(function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('books')->middleware('can:read-books')->group(function(){
        Route::get('', [BookController::class, 'index'])->name('admin.books');
        Route::get('getData', [BookController::class, 'getData'])->name('admin.books.getData');
    });

    Route::prefix('members')->middleware('can:read-books')->group(function(){
        Route::get('', [MemberController::class, 'index'])->name('admin.members');
        Route::get('getData', [MemberController::class, 'getData'])->name('admin.members.getData');
    });

    Route::prefix('roles')->middleware('can:read-books')->group(function(){
        Route::get('', [RoleController::class, 'index'])->name('admin.roles');
        Route::get('getData', [RoleController::class, 'getData'])->name('admin.roles.getData');
    });

    Route::prefix('users')->middleware('can:read-users')->group(function(){
        Route::get('', [UserController::class, 'index'])->name('admin.users');
        Route::get('getData', [UserController::class, 'getData'])->name('admin.users.getData');
        Route::get('create', [UserController::class, 'create'])->name('admin.users.create')->middleware('can:create-users');
        Route::post('store', [UserController::class, 'store'])->name('admin.users.store')->middleware('can:create-users');
        Route::get('{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit')->middleware('can:update-users');
        Route::post('{user}/update', [UserController::class, 'update'])->name('admin.users.update')->middleware('can:update-users');
        Route::delete('{user}/delete', [UserController::class, 'destroy'])->name('admin.users.delete')->middleware('can:delete-users');
    });
});