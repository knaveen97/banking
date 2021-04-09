<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'get'])->name('profile');
Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'patch'])->name('profile');

Route::post('/accounts/create',[App\Http\Controllers\AccountController::class, 'createAccount'])->name('accounts');
Route::get('/accounts', [App\Http\Controllers\AccountController::class, 'index'])->name('accounts');

Route::get('/transactions', [App\Http\Controllers\TransactionController::class, 'index'])->name('transactions');


Route::post('/bills/pay', [App\Http\Controllers\BillPaymentController::class, 'payBill'])->name('billpayments');
Route::get('/bills', [App\Http\Controllers\BillPaymentController::class, 'index'])->name('billpayments');


Route::post('/transfer/initiate', [App\Http\Controllers\TransferController::class, 'initiateTransfer'])->name('transfers');
Route::get('/transfer', [App\Http\Controllers\TransferController::class, 'index'])->name('transfers');
