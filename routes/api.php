<?php

use App\Http\Controllers\CobaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Master\JnsBayarController;
use App\Http\Controllers\Master\KategoriController;
use App\Http\Controllers\Master\PelangganController;
use App\Http\Controllers\Master\ProdukController;
use App\Http\Controllers\Master\SatuanController;
use App\Http\Controllers\Transaksi\PembayaranController;
use App\Http\Controllers\Transaksi\TransaksiController;
use App\Http\Controllers\Transaksi\TransaksirinciController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PakeQuasar\Master\MasterController;
use App\Http\Controllers\Transaksi\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
// new with Quasar
Route::get('/getproduk',[MasterController::class,'getproduk']);
Route::post('/tambahproduk',[MasterController::class,'tambahproduk']);
Route::post('/hapusproduk',[MasterController::class,'hapusproduk']);

Route::get('/getkategori',[MasterController::class,'getkategori']);
Route::get('/getsatuan',[MasterController::class,'getsatuan']);

Route::get('/datapelanggan',[MasterController::class,'datapelanggan']);
Route::post('/tambahpelanggan',[MasterController::class,'tambahpelanggan']);
Route::post('/hapuspelanggan',[MasterController::class,'hapuspelanggan']);
