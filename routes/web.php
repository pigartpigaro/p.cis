<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Master\KategoriController;
use App\Http\Controllers\Master\PelangganController;
use App\Http\Controllers\Master\SatuanController;
use App\Http\Controllers\Master\ProdukController;
use App\Http\Controllers\Transaksi\OrderRinciController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Transaksi\OrderController;

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
 
// route bawaan default laravel
Route::get('/', function () {
	return view('start',["title" => ""]);
});

Route::get('/start', function () {
	return view('layout.bg',["title" => ""]);
});


Route::get('/home', function () {
	return view('home',[
		'active' => 'home',
	]);
	})->name('home')->middleware('auth');
// Route::get('/pelanggan', function () {
// 	return view('master.pelanggan',["title" => "Pelanggan"]);
// });
Route::get('/register', [RegisterController::class, 'getreg'])->name('register');
Route::post('/postregister', [RegisterController::class, 'newreg']);


Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/postlogin', [LoginController::class, 'authlogin'])->name('authlogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


// Route::get('/pelanggan', [PelangganController::class, 'getpelanggan'])->name('pelanggan')->middleware('auth');
// Route::post('/postpelanggan', [PelangganController::class, 'postpelanggan']) ->name('postpelanggan')->middleware('auth');
// Route::get('/pelanggan/{id}/edit', [PelangganController::class, 'viewedit']) ->name('viewedit')->middleware('auth');
// Route::post('/pelanggan/update', [PelangganController::class, 'updatepelanggan']) ->name('updatepelanggan')->middleware('auth');
// Route::post('/pelanggan/hapus/{id}', [PelangganController::class, 'destroy']) ->name('delete')->middleware('auth');

//Route Pelanggan
Route::resource('pelanggan', PelangganController::class)->middleware('auth');
// Route::resource('/pelanggan', PelangganController::class)->middleware('auth');

//Route Kategori
Route::resource('kategori', KategoriController::class)->middleware('auth');

//Route Produk
Route::resource('produk', ProdukController::class)->middleware('auth');

//Route Satuan
Route::resource('satuan', SatuanController::class)->middleware('auth');

// Route::get('/laporan', function () {
// 	return view('laporan',["title" => "Laporan"]);
// });
Route::get('/laporan/json', [LaporanController::class, 'data'])->name('laporan.data');
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::post('/postlaporan', [LaporanController::class, 'store'])->name('laporan.store');


// Route::get('/order', function () {
// 	return view('transaksi.order',["title" => ""]);
// });

//Route Order
Route::get('/order/{id}/create', [OrderController::class, 'create'])->name('order.create');
Route::get('/order/{id}/edit', [OrderController::class, 'edit'])->name('order.edit');
Route::resource('order', OrderController::class)->middleware('auth')->except('create', 'edit');
Route::get('/order/cetak/{id}', [OrderController::class, 'cetak'])->name('order.cetak');

// Route::resource('orderrinci', OrderRinciController::class)->middleware('auth')->except('create', 'show', 'edit', 'destroy');
Route::get('/orderrinci', [OrderRinciController::class, 'index'])->name('orderrinci.index');
Route::post('/orderrinci/store', [OrderRinciController::class, 'store'])->name('orderrinci.store');
Route::get('/orderrinci/{id}/data', [OrderRinciController::class, 'data'])->name('orderrinci.data');
Route::post('/orderrinci/{id}/destroy', [OrderRinciController::class, 'destroy'])->name('orderrinci.destroy');
Route::get('/order/cetak/{id}', [OrderRinciController::class, 'cetak'])->name('orderrinci.cetak');

// Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('auth');
// Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

//REGISTER

