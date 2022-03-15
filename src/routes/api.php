<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;



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

// ログインユーザー
Route::get('/user', fn() => Auth::user())->name('user');
// 会員登録
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// ログイン
Route::post('/login', [LoginController::class, 'login'])->name('login');

// ログアウト
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
