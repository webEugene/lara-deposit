<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositsController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
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

Route::get(
    '/',
    function () {
        return view('home');
    }
)->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/user/{id}', [UserController::class, 'show'])->name('user.index');
Route::get('/deposits', [DepositsController::class, 'index'])->name('deposits.index');
Route::get('/transactions', [TransactionsController::class, 'index'])->name('transactions.index');

Route::post('/register', [RegisterController::class, 'registerNewUser']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LogoutController::class, 'loggedOut'])->name('logout');

Route::resource(
    '/wallet',
    'WalletController',
);
Route::resource(
    '/deposits',
    'DepositsController',
);

