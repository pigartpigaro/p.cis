<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Master\Produk;
use App\Models\Transaksi\Transaksirinci;
use Illuminate\Http\Request;

class TransaksirinciController extends Controller
{
    public function gettransrinci(){
        $data=Transaksirinci::with(['transaksi','produk'])
        ->get();
        return response()->json($data);
    }
    
    public function posttransrinci(Request $request){
        //$cariproduk adalah proses memanggil model produk utk mncari id
        $cariproduk = Produk::where('id','=',$request->produk_id)->first();
        //$hargaproduk adalah hasil pncarian variabel dlam Produk 
        $hargaproduk = $cariproduk->harga;

        $data=Transaksirinci::create([
            'transaksi_id'=> $request->transaksi_id,
            'produk_id'=> $request->produk_id,
            'kuantitas'=> $request->kuantitas,
            'harga_id' => $hargaproduk,
            // 'total'=> ($hargaproduk)*($request->kuantitas),       
        ]);

        return response()->json($data);
    }
    public function updatetransrinci(Request $request){
        $data=Transaksirinci::find($request->id);
        if(!$data){
            return response()->json('NotValid',500);
        }  
        
        $cariproduk = Produk::where('id','=',$request->produk_id)->first();
        $hargaproduk = $cariproduk->harga;
        $data->update([
            'transaksi_id'=> $request->transaksi_id,
            'produk_id'=> $request->produk_id,
            'kuantitas'=> $request->kuantitas,
            'harga'=> $hargaproduk,
        ]);

        return response()->json('Success');
    }

    public function deletetransrinci(Request $request){
        $data=Transaksirinci::find($request->id);
        if(!$data){
            return response()->json('NotValid',500);
        }
        $data->delete();

        return response()->json('Success');
    }
}
