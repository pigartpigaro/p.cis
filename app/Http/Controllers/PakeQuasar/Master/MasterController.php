<?php

namespace App\Http\Controllers\PakeQuasar\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Kategori;
use App\Models\Master\Pelanggan;
use App\Models\Master\Produk;
use App\Models\Master\Satuan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterController extends Controller
{
    public function getproduk(){
        $produk = Produk::select('id','nama','harga','kategori_id', 'satuan_id')->with('kategori', function ($nama){
            $nama->select('kategoris.id','kategoris.nama');
        }, 'satuan', function ($nm){
            $nm->select('satuans.id', 'satuans.nama');
        })
        ->when(request('q'),function ($query) {
            $query->where('nama', 'LIKE', '%' . request('q') . '%');
        })->paginate(request('per_page'));
        $collect = collect($produk);
        $balik = $collect->only('data');
        $balik['meta'] = $collect->except('data');
        return new JsonResponse($balik);
    }
    public function getkategori(){
        $kategori = Kategori::when(request('q'),function ($query) {
            $query->where('nama', 'LIKE', '%' . request('q') . '%');
        })->get();

        return new JsonResponse($kategori);
    }
    public function getsatuan(){
        $satuan = Satuan::when(request('q'),function ($query) {
            $query->where('nama', 'LIKE', '%' . request('q') . '%');
        })->get();
        return new JsonResponse($satuan);
    }
    public function tambahproduk(Request $request){
        try{
            DB::beginTransaction();
            if (!$request->has('id')) {
                Produk::firstOrCreate($request->only([
                    'nama',
                    'harga',
                    'kategori_id',
                    'satuan_id'
                ]));
            } else {
                $produk = Produk::find($request->id);
                $produk->update($request->only([
                    'nama',
                    'harga',
                    'kategori_id',
                    'satuan_id'
                ]));
            }
            DB::commit();
            return response()->json(['message' => 'Succes'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'ada kesalahan', 'error' => $e], 500);
        }
        // $tambah = Produk::create([
        //     'nama'=> $request->nama,
        //     'harga'=> $request->harga,
        //     'kategori_id'=> $request->kategori_id,
        //     'satuan_id'=> $request->satuan_id,
        // ]);
        // return response()->json(['message' => 'Berhasil di Simpan', 'data' =>$tambah], 200);
    }
    public function hapusproduk(Request $request){
        $id=$request->id;
        $data=Produk::find($id);
        $del=$data->delete();
        if(!$del){
            return response()->json([
                'message' => 'Error on Delete'
            ], 500);
        }
        return response()->json([
            'message' => 'Data sukses terhapus'
        ], 200);
    }


    // Pelanggan
    public function datapelanggan(){
        $data=Pelanggan::when(request('q'),function ($query) {
            $query->where('nama', 'LIKE', '%' . request('q') . '%')
                ->orWhere('alamat', 'LIKE', '%' . request('q') . '%')
                ->orWhere('nohp', 'LIKE', '%' . request('q') . '%');
        })->paginate(request('per_page'));
        $collect = collect($data);
        $balik = $collect->only('data');
        $balik['meta'] = $collect->except('data');
        return new JsonResponse($balik);
    }

    public function tambahpelanggan(Request $request){
        try{
            DB::beginTransaction();
            if (!$request->has('id')) {
                Pelanggan::firstOrCreate($request->only([
                    'nama',
                    'alamat',
                    'nohp'
                ]));
            } else {
                $data = Pelanggan::find($request->id);
                $data->update($request->only([
                    'nama',
                    'alamat',
                    'nohp'
                ]));
            }
            DB::commit();
            return response()->json(['message' => 'Succes'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'ada kesalahan', 'error' => $e], 500);
        }
        // $tambah = Produk::create([
        //     'nama'=> $request->nama,
        //     'harga'=> $request->harga,
        //     'kategori_id'=> $request->kategori_id,
        //     'satuan_id'=> $request->satuan_id,
        // ]);
        // return response()->json(['message' => 'Berhasil di Simpan', 'data' =>$tambah], 200);
    }
    public function hapuspelanggan(Request $request){
        $id=$request->id;
        $data=Pelanggan::find($id);
        $del=$data->delete();
        if(!$del){
            return response()->json([
                'message' => 'Error on Delete'
            ], 500);
        }
        return response()->json([
            'message' => 'Data sukses terhapus'
        ], 200);
    }
}
