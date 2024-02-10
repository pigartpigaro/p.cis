<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(){
        return view('master.kategori.kategori', [
            'kategori'=>Kategori::latest()
            ->filter(request(['search']))
            ->paginate(5)->withQueryString()
            
    ]);
}
    public function create()
    {
        return view('master.kategori.kategori');
    }
    public function store(Request $request){
        Kategori::create([
            'nama'=> $request->nama,
        ]);
        
        return redirect('/kategori')->with('success','Berhasil Disimpan');
        // return response()->json($data);
    }

    public function edit(kategori $kategori){
        return view('master.kategori.edit',[
            'kategori' => $kategori,
            'kategoris' => Kategori::all()
        ]);
    }

    public function update(Request $request, string $id){
        
        $kategori = $request -> validate([
            'nama' => 'required',
            
        ]);
        $kategori['id'] = auth()->user()->id;
        Kategori::find($id)
        ->update($kategori);

        return redirect('/kategori')->with('success','Berhasil Disimpan');
    }
    public function destroy(string $id){
        $data=Kategori::find($id);
        // if(!$data){
        //     return response()->with('invalid','Gagal Dihapus');
        // }
        $data->delete();

        return redirect('/kategori')->with('success','Berhasil Dihapus');
    }
}