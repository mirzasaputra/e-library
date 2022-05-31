<?php

use Illuminate\Support\Facades\Route;
// FrontEnd
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\BookingController;

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
Route::get('/{book}/detail', [KatalogController::class, 'detail'])->name('detail');
Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog');
Route::get('/booking', [BookingController::class, 'index'])->name('booking');
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
        Route::get('create', [BookController::class, 'create'])->name('admin.books.create')->middleware('can:create-books');
        Route::post('store', [BookController::class, 'store'])->name('admin.books.store')->middleware('can:create-books');
        Route::get('{book}/edit', [BookController::class, 'edit'])->name('admin.books.edit')->middleware('can:update-books');
        Route::post('{book}/update', [BookController::class, 'update'])->name('admin.books.update')->middleware('can:update-books');
        Route::delete('{book}/delete', [BookController::class, 'destroy'])->name('admin.books.delete')->middleware('can:delete-books');
    });

    Route::prefix('members')->middleware('can:read-members')->group(function(){
        Route::get('', [MemberController::class, 'index'])->name('admin.members');
        Route::get('getData', [MemberController::class, 'getData'])->name('admin.members.getData');
        Route::get('create', [MemberController::class, 'create'])->name('admin.members.create')->middleware('can:create-members');
        Route::post('store', [MemberController::class, 'store'])->name('admin.members.store')->middleware('can:create-members');
        Route::get('{member}/edit', [MemberController::class, 'edit'])->name('admin.members.edit')->middleware('can:update-members');
        Route::post('{member}/update', [MemberController::class, 'update'])->name('admin.members.update')->middleware('can:update-members');
        Route::delete('{member}/delete', [MemberController::class, 'destroy'])->name('admin.members.delete')->middleware('can:delete-members');
    });

    Route::prefix('roles')->middleware('can:read-roles')->group(function(){
        Route::get('', [RoleController::class, 'index'])->name('admin.roles');
        Route::get('getData', [RoleController::class, 'getData'])->name('admin.roles.getData');
        Route::post('store', [RoleController::class, 'store'])->name('admin.roles.store')->middleware('can:create-roles');
        Route::get('{id}/edit', [RoleController::class, 'edit'])->name('admin.roles.edit')->middleware('can:update-roles');
        Route::post('{id}/update', [RoleController::class, 'update'])->name('admin.roles.update')->middleware('can:update-roles');
        Route::delete('{id}/delete', [RoleController::class, 'destroy'])->name('admin.roles.delete')->middleware('can:delete-roles');
        Route::get('{id}/change', [RoleController::class, 'show'])->name('admin.roles.change')->middleware('can:update-roles');
        Route::post('{id}/update-permission', [RoleController::class, 'changePermission'])->name('admin.roles.update-permission')->middleware('can:update-roles');
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