<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ClassificationController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TagController;
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
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
});

Route::prefix('movies')->group(function () {
    Route::get('/', [MovieController::class, 'index'])->name('movies-index');
    Route::get('/{id}/edit', [MovieController::class, 'edit'])->where('id', '[0-9]+')->name('movies-edit')->middleware('auth');
    Route::get('/create', [MovieController::class, 'create'])->name('movies-create')->middleware('auth');
    Route::delete('/{id}', [MovieController::class, 'destroy'])->where('id', '[0-9]+')->name('movies-destroy')->middleware('auth');
    Route::put('/{id}', [MovieController::class, 'update'])->name('movies-update')->middleware('auth');
    Route::post('/', [MovieController::class, 'store'])->name('movies-store')->middleware('auth');
});

Route::prefix('rooms')->group(function () {
    Route::get('/', [RoomController::class, 'index'])->name('rooms-index')->middleware('auth');
    Route::get('/create', [RoomController::class, 'create'])->name('rooms-create')->middleware('auth');
    Route::get('/{id}/edit', [RoomController::class, 'edit'])->where('id', '[0-9]+')->name('rooms-edit')->middleware('auth');
    Route::delete('/{id}', [RoomController::class, 'destroy'])->where('id', '[0-9]+')->name('rooms-destroy')->middleware('auth');
    Route::put('/{id}', [RoomController::class, 'update'])->name('rooms-update')->middleware('auth');
    Route::post('/', [RoomController::class, 'store'])->name('rooms-store')->middleware('auth');
});

Route::prefix('/sessions')->group(function () {
    Route::get('/', [SessionController::class, 'index'])->name('sessions-index');
    Route::get('/create', [SessionController::class, 'create'])->name('sessions-create')->middleware('auth');
    Route::get('/edit/{id}', [SessionController::class, 'edit'])->where('id', '[0-9]+')->name('sessions-edit')->middleware('auth');
    Route::delete('/{id}', [SessionController::class, 'destroy'])->where('id', '[0-9]+')->name('sessions-destroy')->middleware('auth');
    Route::post('/', [SessionController::class, 'store'])->name('sessions-store')->middleware('auth');
    Route::put('/{id}', [SessionController::class, 'update'])->name('sessions-update')->middleware('auth');
    Route::get('/show/{id}', [SessionController::class, 'show'])->name('sessions-show');
});

Route::prefix('classifications')->group(function () {
    Route::get('/', [ClassificationController::class, 'index'])->name('classifications-index')->middleware('auth');
    Route::get('/create', [ClassificationController::class, 'create'])->name('classifications-create')->middleware('auth');
    Route::get('/{id}/edit', [ClassificationController::class, 'edit'])->where('id', '[0-9]+')->name('classifications-edit')->middleware('auth');
    Route::delete('/{id}', [ClassificationController::class, 'destroy'])->where('id', '[0-9]+')->name('classifications-destroy')->middleware('auth');
    Route::put('/{id}', [ClassificationController::class, 'update'])->name('classifications-update')->middleware('auth');
    Route::post('/', [ClassificationController::class, 'store'])->name('classifications-store')->middleware('auth');
});

Route::prefix('tags')->group(function () {
    Route::get('/', [TagController::class, 'index'])->name('tags-index')->middleware('auth');
    Route::get('/create', [TagController::class, 'create'])->name('tags-create')->middleware('auth');
    Route::get('/{id}/edit', [TagController::class, 'edit'])->where('id', '[0-9]+')->name('tags-edit')->middleware('auth');
    Route::delete('/{id}', [TagController::class, 'destroy'])->where('id', '[0-9]+')->name('tags-destroy')->middleware('auth');
    Route::put('/{id}', [TagController::class, 'update'])->name('tags-update')->middleware('auth');
    Route::post('/', [TagController::class, 'store'])->name('tags-store')->middleware('auth');
});

Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/', [HomeController::class, 'index'])->name('index');



Route::get('/login', [AuthenticationController::class, 'login'])->name('login-form');
Route::post('/login', [AuthenticationController::class, 'logar'])->name('login');
Route::get('/allsessions', [HomeController::class, 'allSessions'])->name('all-sessions');


Route::fallback(function () {
    return "404 not found";
});
