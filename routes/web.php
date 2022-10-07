<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Authenticate;
use GuzzleHttp\Middleware;
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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/search', [HomeController::class, 'search'])->name('search');
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
});

Route::prefix('movies')->group(function () {
    Route::get('/', [MovieController::class, 'index'])->name('movies-index')->middleware('auth');
    Route::get('/{id}/edit', [MovieController::class, 'edit'])->where('id', '[0-9]+')->name('movies-edit')->middleware('auth');
    Route::get('/create', [MovieController::class, 'create'])->name('movies-create')->middleware('auth');
    Route::delete('/{id}', [MovieController::class, 'destroy'])->where('id', '[0-9]+')->name('movies-destroy')->middleware('auth');
    Route::put('/{id}', [MovieController::class, 'update'])->name('movies-update')->middleware('auth')->middleware('auth');
    Route::post('/', [MovieController::class, 'store'])->name('movies-store')->middleware('auth')->middleware('auth');
});

Route::prefix('rooms')->group(function () {
    Route::get('/', [RoomController::class, 'index'])->name('rooms-index')->middleware('auth');
    Route::get('/create', [RoomController::class, 'create'])->name('rooms-create')->middleware('auth');
    Route::get('/{id}/edit', [RoomController::class, 'edit'])->where('id', '[0-9]+')->name('rooms-edit')->middleware('auth');
    Route::delete('/{id}', [RoomController::class, 'destroy'])->where('id', '[0-9]+')->name('rooms-destroy')->middleware('auth');
    Route::put('/{id}', [RoomController::class, 'update'])->name('rooms-update')->middleware('auth')->middleware('auth');
    Route::post('/', [RoomController::class, 'store'])->name('rooms-store')->middleware('auth')->middleware('auth');
});

Route::prefix('/sessions')->group(function () {
    Route::get('/create', [SessionController::class, 'create'])->name('sessions-create')->middleware('auth');
    Route::get('/edit/{id}', [SessionController::class, 'edit'])->where('id', '[0-9]+')->name('sessions-edit')->middleware('auth');
    Route::delete('/{id}', [SessionController::class, 'destroy'])->where('id', '[0-9]+')->name('sessions-destroy')->middleware('auth');
    Route::post('/', [SessionController::class, 'store'])->name('sessions-store')->middleware('auth');
    Route::put('/{id}', [SessionController::class, 'update'])->name('sessions-update')->middleware('auth')->middleware('auth');
    Route::get('/show/{id}', [SessionController::class, 'show'])->name('sessions-show')->middleware('auth');
});


//Autentication

Route::get('/login', [AuthenticationController::class, 'login'])->name('login-form');
Route::post('/login', [AuthenticationController::class, 'logar'])->name('login');


Route::fallback(function () {
    return "404 not found";
});

