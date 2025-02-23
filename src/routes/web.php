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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'login']);

Route::get('/admin', [AdminController::class, 'admin']);

Route::get('/contact', [ContactController::class, 'contact']);

Route::get('/confirm', [ConfirmController::class, 'confirm']);

Route::get('/thanks', [ThanksController::class, 'thanks']);
