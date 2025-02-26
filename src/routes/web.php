<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ConfirmController;
use App\Http\Controllers\ThanksController;


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

// 認証・管理系ルート
Route::get('/auth/register', [AuthController::class, 'register'])->name('register');
Route::post('/auth/register', [AuthController::class, 'register'])->name('register');

Route::get('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');

Route::get('/admin', [AdminController::class, 'admin']);

// 入力画面（トップページも含む）
Route::get('/', [ContactController::class, 'create'])->name('contact.create');
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::delete('/contact/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');


// 入力内容の受け取りと確認画面への遷移
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// 送信処理（DB登録後、thanks へ）
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

// 確認画面の表示・送信（確認画面は GET で表示、送信処理は POST で別ルートを利用するケース）
Route::get('/confirm', [ConfirmController::class, 'confirm'])->name('confirm');
Route::post('/confirm', [ConfirmController::class, 'submit'])->name('confirm.submit');

// 修正用：入力画面へ戻る
Route::get('/contact/edit', [ContactController::class, 'edit'])->name('contact.edit');

// 完了画面
Route::get('/thanks', [ThanksController::class, 'thanks'])->name('thanks');