<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PhotoController;
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

// 写真投稿
Route::post('/photos', [PhotoController::class, 'create'])->name('photo.create');

// 写真一覧
Route::get('/photos', [PhotoController::class, 'index'])->name('photo.index');

// 写真詳細
Route::get('/photos/{id}', [PhotoController::class, 'show'])->name('photo.show');

// コメント
Route::post('/photos/{photo}/comments', [PhotoController::class, 'addComment'])->name('photo.comment');

// いいね
Route::put('/photos/{id}/like', [PhotoController::class, 'like'])->name('photo.like');

// いいね解除
Route::delete('/photos/{id}/like', [PhotoController::class, 'unlike']);

// トークンリフレッシュ
Route::get('/reflesh-token', function (Request $request) {
    $request->session()->regenerateToken();

    return response()->json();
});