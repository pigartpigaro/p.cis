<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Produk;
use App\Models\Master\Kategori;
use App\Models\Master\Satuan;
use Illuminate\Http\Request;
use DataTables;
use Yajra\DataTables\DataTables as DataTablesDataTables;

class ProdukController extends Controller
{
    public function index(){
        return view('master.produk.produk', [
            'produk'=>Produk::latest()
            // 'produk'=>Produk::with('kategori')->latest()
            ->filter(request(['search','kategori']))
            ->paginate(10)->withQueryString()
        ]);
    }

    public function create()
    {
        return view('master.produk.tambah',[
            'kategoris' => Kategori::all(),
            'satuans' => Satuan::all()
        ]);
    }

    public function store(Request $request){
       //   Cara post Pertama
        // $data=new Produk;
        // $data->nama = $request->nama;
        // $data->harga = $request->harga;
        // $data->kategori_id = $request->kategori_id;
        // $data->satuan_id = $request->satuan_id;
        // $data->save();

    //  Cara post Kedua
        // Produk::create([
        //     'nama'=> $request->nama,
        //     'harga'=> $request->harga,
        //     'kategori_id'=> $request->kategori_id,
        //     'satuan_id'=> $request->satuan_id,

        // ]);
    //  Cara Ketiga
        $validator = $request -> validate([
            'nama' => 'required|max:255',
            'harga' => 'required|numeric',
            'kategori_id'=> 'required',
            'satuan_id'=> 'required',
        ]);
        $validator['id'] = auth()->user()->id;


        Produk::create($validator);
        return redirect('/produk')->with('success','Berhasil Disimpan');
    }

    public function edit(Produk $produk)
    {
        return view('master.produk.edit',[
            'produk' => $produk,
            'produks' => Produk::all(),
            'kategoris' => Kategori::all(),
            'satuans' => Satuan::all()
        ]);
    }
    public function update(Request $request, string $id)
    {
        $validator = $request -> validate([
            'nama' => 'required|max:255',
            'harga' => 'required',
            'kategori_id'=> 'required',
            'satuan_id'=> 'required',
        ]);
        $validator['id'] = auth()->user()->id;
        Produk::find($id)
        ->update($validator);


        // $edit = Pelanggan::find($id);
        // $edit->update($request->all());
        return redirect('/produk')->with('success', 'Edit Berhasil.');
    }

    public function destroy(Request $data, String $id)
    {

        $data=Produk::find($id);
        // if(!$data){
            //     return response()->json('NotValid',500);
            // }
        $data->delete();
        return redirect('/produk')->with('success','Berhasil Dihapus');
    }
}
