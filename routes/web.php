<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;

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
})->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() { 
    Route::get('/pelanggan/{pelanggan}/download', [App\Http\Controllers\PelangganController::class, 'getDownload'])->name('pelanggan.download');
    Route::resource('pelanggan', PelangganController::class);
});
