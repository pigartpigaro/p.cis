<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Jns_Bayar;
use Illuminate\Http\Request;

class JnsBayarController extends Controller
{
    public function getbayar(){
        $data=Jns_Bayar::get();
        return response()->json($data);
    }
    
    public function postbayar(Request $request){
        $data=Jns_Bayar::create([
            'nama'=> $request->nama,
        ]);

        return response()->json($data);
    }
    
    public function updatebayar(Request $request){
        $data=Jns_Bayar::find($request->id);
        if(!$data){
            return response()->json('NotValid',500);
        }
        $data->update([
            'nama'=> $request->nama,
        ]);
        return response()->json('Success');
    }
    
    public function deletebayar(Request $request){
        $data=Jns_Bayar::find($request->id);

        if(!$data){
            return response()->json('NotValid',500);
        }
        $data->delete();
        return response()->json('Success');
    }
}
