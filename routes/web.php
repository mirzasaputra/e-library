<?php

use Illuminate\Support\Facades\Route;
// FrontEnd
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\BookingController;

// BackEnd
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Genre\GenreController;
use App\Http\Controllers\Book\BookController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Borrow\BorrowController;
use App\Http\Controllers\Booking\BookingController as BookingAdministratorController;

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
Route::get('/katalog/{genre_id}', [KatalogController::class, 'getData'])->name('katalog.getData');
Route::prefix('booking')->middleware('auth')->group(function(){
    Route::get('', [BookingController::class, 'index'])->name('booking');
    Route::get('{status?}/filter', [BookingController::class, 'index'])->name('booking.filter');
    Route::get('{book_id}/store', [BookingController::class, 'store'])->name('booking.store');
    Route::get('{transactionDetail}/delete', [BookingController::class, 'destroy'])->name('booking.delete');
    Route::get('checkout', [BookingController::class, 'checkoutShow'])->name('booking.checkout');
    Route::post('checkout', [BookingController::class, 'checkout'])->name('booking.checkout.store');
    Route::get('{transaction}/show-qr-code', [BookingController::class, 'showQrCode'])->name('booking.showQrCode');
});
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact');

/* Backend */
Route::prefix('auth')->middleware('guest')->group(function(){
    Route::get('/', [AuthController::class, 'index'])->name('auth');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/register/store', [AuthController::class, 'store'])->name('auth.register.store');
});
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::prefix('administrator')->middleware('auth')->group(function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('can:read-dashboard');

    Route::prefix('genres')->middleware('can:read-genres')->group(function(){
        Route::get('', [GenreController::class, 'index'])->name('admin.genres');
        Route::get('getData', [GenreController::class, 'getData'])->name('admin.genres.getData');
        Route::post('store', [GenreController::class, 'store'])->name('admin.genres.store');
        Route::get('{genre}/edit', [GenreController::class, 'edit'])->name('admin.genres.edit');
        Route::post('{genre}/update', [GenreController::class, 'update'])->name('admin.genres.update');
        Route::delete('{genre}/delete', [GenreController::class, 'destroy'])->name('admin.genres.delete');
    });

    Route::prefix('books')->middleware('can:read-books')->group(function(){
        Route::get('', [BookController::class, 'index'])->name('admin.books');
        Route::get('getData', [BookController::class, 'getData'])->name('admin.books.getData');
        Route::get('create', [BookController::class, 'create'])->name('admin.books.create')->middleware('can:create-books');
        Route::post('store', [BookController::class, 'store'])->name('admin.books.store')->middleware('can:create-books');
        Route::get('{book}/detail', [BookController::class, 'detail'])->name('admin.books.detail');
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

    Route::prefix('borrows')->middleware('can:read-borrows')->group(function(){
        Route::get('', [BorrowController::class, 'index'])->name('admin.borrows');
        Route::get('getData', [BorrowController::class, 'getData'])->name('admin.borrows.getData');
        Route::get('getDataBook', [BorrowController::class, 'getDataBook'])->name('admin.borrows.getDataBook');
        Route::post('{book_id}/store', [BorrowController::class, 'store'])->name('admin.borrows.store');
        Route::post('checkout', [BorrowController::class, 'checkout'])->name('admin.borrows.checkout');
        Route::delete('{transactionDetail}/delete', [BorrowController::class, 'destroy'])->name('admin.borrows.delete');
    });

    Route::prefix('bookings')->middleware('can:read-bookings')->group(function(){
        Route::get('', [BookingAdministratorController::class, 'index'])->name('admin.bookings');
    });
});