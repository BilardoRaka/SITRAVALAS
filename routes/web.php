<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardForexController;
use App\Http\Controllers\DashboardAccountController;
use App\Http\Controllers\DashboardCustomerController;
use App\Http\Controllers\DashboardTransactionController;

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


Route::get('/', [LoginController::class,'index'])->name('login')->middleware('guest');
Route::get('/login', function() {
    abort(404);
});
Route::post('/login', [LoginController::class,'authenticate'])->middleware('guest');
Route::get('/logout', function() {
    abort(404);
});
Route::post('/logout', [LoginController::class,'logout']);
Route::get('/dashboard', [DashboardController::class,'index'])->middleware('auth');
Route::get('/dashboard/deteksiLokasi', [DashboardController::class,'getLocation'])->middleware('cabang');
Route::post('/dashboard/deteksiLokasi', [DashboardController::class,'newLocation'])->middleware('cabang');


Route::resource('/dashboard/accounts', DashboardAccountController::class)->except('show')->middleware('admin');
Route::resource('/dashboard/forexes', DashboardForexController::class)->except('show','edit','update')->middleware('auth');
Route::resource('/dashboard/customers', DashboardCustomerController::class)->except('show')->middleware('auth');
Route::resource('/dashboard/transactions', DashboardTransactionController::class)->except('show','create')->middleware('auth');

Route::get('/dashboard/transactions/customer',[DashboardTransactionController::class,'customer'])->middleware('auth');
Route::get('/dashboard/customers/print',[DashboardCustomerController::class,'printPreview'])->name('customer.pdf')->middleware('auth');
Route::post('/dashboard/transactions/capital', [DashboardTransactionController::class, 'ModalMasuk'])->middleware('auth');
Route::get('/dashboard/transactions/{id}/print',[DashboardTransactionController::class,'invoice'])->middleware('auth');
Route::get('/dashboard/customers/{id}/history',[DashboardCustomerController::class,'history'])->middleware('auth');

Route::get('/dashboard/transactions/rekapitulasi', [DashboardTransactionController::class, 'rekapitulasi'])->middleware('auth');