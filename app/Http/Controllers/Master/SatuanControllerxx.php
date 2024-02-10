<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    public function getsatuan(){
        return view('master.satuan.satuan', [
            'satuan'=>Satuan::latest()
            ->filter(request(['search']))
            ->paginate(5)->withQueryString()
            
    ]);
        // $data=Satuan::get();
        // return response()->json($data);
    }
    
    public function lihat(){
        return view('master.satuan.postsatuan', [
            
    ]);
        // $data=Satuan::get();
        // return response()->json($data);
    }

    public function postsatuan(Request $request){
        Satuan::create([
            'nama'=> $request->nama, 
        ]);
        return redirect('/satuan')->with('success','Simpan Berhasil');
        // return response()->json($data);
    }
    
    public function edit(Request $satuan){
        return view('master.satuan.edit', [
            'satuan' => $satuan,
            'satuans' => Satuan::all()
    ]);
        // $data=Satuan::get();
        // return response()->json($data);
    }
    public function updatesatuan(Request $request, Satuan $id){
        $data = [
            'nama' => $request->nama,
        ];
        Satuan::find($id)
        ->update($data);
        return redirect('/satuan')->with('success','Berhasil Disimpan');
    }
    
    public function deletesatuan(Request $request){
        $data=Satuan::find($request->id);

        if(!$data){
            return redirect('/satuan')->with('NotValid',500);
        }
        $data->delete();
        return redirect('/satuan')->with('success','Berhasil Dihapus');
    }

    // public function restoresatuan(Request $request){
    //     $data=Satuan::find($request->id);
    //     $data->history()->restore();

    //     return response()->json($data);
    // }
}

