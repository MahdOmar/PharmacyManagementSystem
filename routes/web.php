<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('auth/login');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard/stock', [App\Http\Controllers\ProductController::class, 'index'])->name('stock');
Route::post('/dashboard/product/save',[App\Http\Controllers\ProductController::class, 'store']);
Route::get('/dashboard/product/show',[App\Http\Controllers\ProductController::class, 'show']);
Route::post('/dashboard/product/update',[App\Http\Controllers\ProductController::class, 'update']);
Route::delete('/dashboard/product/delete',[App\Http\Controllers\ProductController::class, 'destroy']);
Route::get('/dashboard/products/filter',[App\Http\Controllers\ProductController::class, 'filter']);


Route::get('/dashboard/sales', [App\Http\Controllers\SaleController::class, 'index']);
Route::get('/dashboard/allsales', [App\Http\Controllers\SaleController::class, 'all']);
Route::post('/dashboard/sales/save',[App\Http\Controllers\SaleController::class, 'store']);
Route::post('/dashboard/sale/save',[App\Http\Controllers\SaleController::class, 'store_sec']);
Route::get('/dashboard/sales/show',[App\Http\Controllers\SaleController::class, 'show']);
Route::post('/dashboard/sales/update',[App\Http\Controllers\SaleController::class, 'update']);
Route::delete('/dashboard/sales/delete',[App\Http\Controllers\SaleController::class, 'destroy']);
Route::get('/dashboard/sales/filter',[App\Http\Controllers\SaleController::class, 'filter']);


Route::get('/dashboard/stats', [App\Http\Controllers\DashboardController::class, 'index']);

Auth::routes();







