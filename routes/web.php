<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NonracikanController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\RacikanController;
use App\Http\Controllers\SignaController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TransaksiNonracikanController;
use App\Models\Nonracikan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/obat', [ObatController::class, 'index'])->name('obat');
    Route::get('/signa', [SignaController::class, 'index'])->name('signa');
    Route::get('/racikan', [RacikanController::class, 'index'])->name('racikan');
    Route::get('/racikan/form', [RacikanController::class, 'show_form'])->name('formracikan');
    Route::post('/racikan', [RacikanController::class, 'store'])->name('transaksiracikan.store');
    Route::get('/racikan/{no_transaksi}', [RacikanController::class, 'show'])->name('show.racikan');
    Route::get('/nonracikan', [NonracikanController::class, 'index'])->name('nonracikan');
    Route::get('/nonracikan/form', [NonracikanController::class, 'show_form'])->name('formnonracikan');
    Route::post('/nonracikan', [NonracikanController::class, 'store'])->name('transaksinonracikan.store');
    Route::get('/nonracikan/{no_transaksi}', [NonracikanController::class, 'show'])->name('show.nonracikan');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
