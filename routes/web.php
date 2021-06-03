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
    return view('auth.login');
});

Route::resource('articulos', 'ArticuloController')->middleware('auth');


Auth::routes();

Route::get('/articulos.index', [App\Http\Controllers\ArticuloController::class, 'index'])->name('articulos');
Route::post('/articulos.cart', [App\Http\Controllers\ArticuloController::class, 'add'])->name('articulos.store');
Route::post('/articulos.cart', [App\Http\Controllers\ArticuloController::class, 'actualizar'])->name('articulos.actualizar');
Route::post('/articulos.cart', [App\Http\Controllers\ArticuloController::class, 'remove'])->name('articulos.remove');
Route::post('/articulos.cart', [App\Http\Controllers\ArticuloController::class, 'clear'])->name('articulos.clear');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', [App\Http\Controllers\ArticuloController::class, 'index'])->name('articulos');
});

