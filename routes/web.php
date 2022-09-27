<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RoomController;
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
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
});

Route::prefix('movies')->group(function () {
    Route::get('/{id}/edit', [MovieController::class, 'edit'])->where('id', '[0-9]+')->name('movies-edit');
    Route::get('/create', [MovieController::class, 'create'])->name('movies-create');
    Route::post('/', [MovieController::class, 'store'])->name('movies-store');
    Route::put('/{id}', [MovieController::class, 'update'])->name('movies-update');
    Route::delete('/{id}', [MovieController::class, 'destroy'])->where('id', '[0-9]+')->name('movies-destroy');
    
    
});

Route::prefix('rooms')->group(function () {
    Route::get('/create', [RoomController::class, 'create'])->name('rooms-create');
    Route::post('/', [RoomController::class, 'store'])->name('rooms-store');
});

// Autentication
Route::get('/login', [AuthenticationController::class, 'login'])->name('login.form');
Route::post('/login', [AuthenticationController::class, 'logar'])->name('login');


Route::fallback(function () {
    return "404 not found";
});
