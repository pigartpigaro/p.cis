<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Transaksi\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function gettransaksi(){
        $data=Transaksi::with(['Transaksirinci','Pelanggan'])
        ->get();
        return response()->json($data);
    }
    
    public function posttransaksi(Request $request){

        $nota = self::buatnomor(); //manggil fungsi yg dbwah
        $tanggal = self::buattanggal();
   
        $data = Transaksi::create([
            'no_nota'=> $nota,
            'tanggal'=> $tanggal,
            'pelanggan_id'=> $request->pelanggan_id,
        ]);

        // $data->transaksirinci()->create([
        //     // 'transaksi_id'=> $data->id,
        //     'produk_id'=> $request->produk_id,
        //     'kuantitas'=> $request->kuantitas,
        //     'total'=> ($request->produk_harga)*($request->kuantitas),
        // ]);

        return response()->json($data);
    }

    public function updatetransaksi(Request $request){
        $data=Transaksi::find($request->id);
        if(!$data){
            return response()->json('NotValid',500);
        }        
        $data->update([
            'pelanggan_id'=> $request->pelanggan_id,
        ]);

        return response()->json('Success');
    }

    public function deletetransaksi(Request $request){
        $data=Transaksi::find($request->id);
        if(!$data){
            return response()->json('NotValid',500);
        }
        $data->delete();

        return response()->json('Success');
    }

    //cara buat penomoran random (sesuai tnggal)
    //string atau 3 kata random
    public static function buatnomor(){
        $huruf = str('NAMI'); 

        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('d');
        $time = date('mis');
        
        //cara menyambungkan antara tgl dn kata dihubungkan tnda .
        $sambung = $tgl.strtoupper($huruf).$time;
        return $sambung;
    }
    //cara buat tanggal
    public static function buattanggal(){
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d');
        return $tanggal;

    }
        
}
