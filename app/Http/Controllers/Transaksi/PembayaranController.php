<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Master\Jns_Bayar;
use App\Models\Transaksi\Pembayaran;
use App\Models\Transaksi\Transaksirinci;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function getpembayaran(){
        $data=Pembayaran::with(['transaksi'])
        ->get();
        return response()->json($data);
    }
    
    public function postpembayaran(Request $request){
        
        $caritotal = Transaksirinci::where('id','=',$request->transaksirinci_id)->first();
        $totalbayar = $caritotal->total;
        $jnsbayar = Jns_Bayar::where('id','=',$request->jnsbayar_id)->first();
        $data=Pembayaran::create([
            'transaksi_id'=> $request->transaksi_id,
            'jnsbayar_id'=> $jnsbayar,
            'total'=> $totalbayar,
            
        ]);

        return response()->json($data);
    }
    
    public function updatepembayaran(Request $request){
        $data=Pembayaran::find($request->id);
        if(!$data){
            return response()->json('NotValid',500);
        }
        $data->update([
            'pelanggan_id'=> $request->pelanggan_id,
            'transaksi_id'=> $request->transaksi_id,
            
            
        ]);
        return response()->json('Success');
    }
    
    public function deletepembayaran(Request $request){
        $data=Pembayaran::find($request->id);

        if(!$data){
            return response()->json('NotValid',500);
        }
        $data->delete();
        return response()->json('Success');
    }
}
