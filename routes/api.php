<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\User\UserController;
use App\Http\Controllers\API\Book\BookController;
use App\Http\Controllers\API\Genre\GenreController;
use App\Http\Controllers\API\Member\MemberController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function() {
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:api')->group(function() {
        Route::get('profile', [AuthController::class, 'getProfile']);

        Route::prefix('users')->group(function() {
            Route::get('', [UserController::class, 'index']);
            Route::post('store', [UserController::class, 'store']);
            Route::get('{user}/find', [UserController::class, 'find']);
            Route::post('{user}/update', [UserController::class, 'update']);
            Route::delete('{user}/delete', [UserController::class, 'destroy']);
        });

        Route::prefix('genres')->group(function() {
            Route::get('', [GenreController::class, 'index']);
            Route::post('store', [GenreController::class, 'store']);
            Route::get('{genre}/find', [GenreController::class, 'find']);
            Route::post('{genre}/update', [GenreController::class, 'update']);
            Route::delete('{genre}/delete', [GenreController::class, 'destroy']);
        });

        Route::prefix('books')->group(function() {
            Route::get('', [BookController::class, 'index']);
            Route::post('store', [BookController::class, 'store']);
            Route::get('{book}/find', [BookController::class, 'find']);
            Route::post('{book}/update', [BookController::class, 'update']);
            Route::delete('{book}/delete', [BookController::class, 'destroy']);
        });

        Route::prefix('members')->group(function() {
            Route::get('', [MemberController::class, 'index']);
            Route::post('store', [MemberController::class, 'store']);
            Route::get('{member}/find', [MemberController::class, 'find']);
            Route::post('{member}/update', [MemberController::class, 'update']);
            Route::delete('{member}/delete', [MemberController::class, 'destroy']);
        });
    });
});


