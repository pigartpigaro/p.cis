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

Route::get('/getkategori',[KategoriController::class,'getkategori']);
Route::post('/postkategori',[KategoriController::class,'postkategori']);
Route::post('/updatekategori',[KategoriController::class,'updatekategori']);
Route::post('/deletekategori',[KategoriController::class,'deletekategori']);

Route::get('/getproduk',[ProdukController::class,'getproduk']);
Route::post('/postproduk',[ProdukController::class,'postproduk']);
Route::post('/updateproduk',[ProdukController::class,'updateproduk']);
Route::post('/deleteproduk',[ProdukController::class,'deleteproduk']);

Route::get('/getsatuan',[SatuanController::class,'getsatuan']);
Route::post('/postsatuan',[SatuanController::class,'postsatuan']);
Route::post('/updatesatuan',[SatuanController::class,'updatesatuan']);
Route::post('/deletesatuan',[SatuanController::class,'deletesatuan']);

Route::get('/getpelanggan',[PelangganController::class,'index']);
Route::post('/postpelanggan',[PelangganController::class,'postpelanggan']);
Route::post('/updatepelanggan',[PelangganController::class,'updatepelanggan']);
Route::post('/deletepelanggan',[PelangganController::class,'deletepelanggan']);

Route::get('/gettransaksi',[TransaksiController::class,'gettransaksi']);
Route::post('/posttransaksi',[TransaksiController::class,'posttransaksi']);
Route::post('/updatetransaksi',[TransaksiController::class,'updatetransaksi']);
Route::post('/deletetransaksi',[TransaksiController::class,'deletetransaksi']);

Route::get('/gettransrinci',[TransaksirinciController::class,'gettransrinci']);
Route::post('/posttransrinci',[TransaksirinciController::class,'posttransrinci']);
Route::post('/updatetransrinci',[TransaksirinciController::class,'updatetransrinci']);
Route::post('/deletetransrinci',[TransaksirinciController::class,'deletetransrinci']);

Route::get('/getbayar',[JnsBayarController::class,'getbayar']);
Route::post('/postbayar',[JnsBayarController::class,'postbayar']);
Route::post('/updatebayar',[JnsBayarController::class,'updatebayar']);
Route::post('/deletebayar',[JnsBayarController::class,'deletebayar']);

Route::get('/getpembayaran',[PembayaranController::class,'getpembayaran']);
Route::post('/postpembayaran',[PembayaranController::class,'postpembayaran']);
Route::post('/updatepembayaran',[PembayaranController::class,'updatepembayaran']);
Route::post('/deletepembayaran',[PembayaranController::class,'deletepembayaran']);

Route::get('/getuser',[RegisterController::class,'getuser']);
Route::post('/postuser',[RegisterController::class,'postuser']);
Route::post('/deleteuser',[RegisterController::class,'deleteuser']);

Route::get('/showlogin',[LoginController::class,'showlogin']);
Route::post('/login',[LoginController::class,'login']);

Route::apiResource('order', OrderController::class);


Route::post('/postlaporan', [LaporanController::class, 'store'])->name('laporan.store');