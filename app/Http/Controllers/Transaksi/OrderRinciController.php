<?php

namespace App\Http\Controllers\Transaksi;


use App\Models\Master\Pelanggan;
use App\Models\Master\Produk;
use App\Http\Controllers\Controller;
use App\Models\Transaksi\Transaksi;
use App\Models\Transaksi\Transaksirinci;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class OrderRinciController extends Controller
{
    public function index(Request $request)
    {
        $transaksi_id = session('transaksi');
        $produks = Produk::orderBy('id')->get();
        $transaksi = Transaksi::where('id', $request->id)->get()->first();
        // $transaksi = Transaksi::find($transaksi_id);
        $transaksirinci = Transaksirinci::where('transaksi_id', $request->id)->get();
        $pelanggan = Pelanggan::find(session('pelanggan_id'));
        if (! $pelanggan) {
            abort(404);
        }
        return view('transaksi.tambah', compact('transaksi_id','produks','pelanggan','transaksi', 'transaksirinci'));
    }

    
    public function store(Request $request)
    {
        // return $request->all();
        $produk = Produk::where('id', $request->id)->first();
        if (! $produk){
            return response()->json('Data Gagal Disimpan',400);
        }
        // pointing dengn produk id didlam modal
        // $kuantitas = 'kuantitas'.$produk->id;
        $rinci = new Transaksirinci();
        // $rinci->transaksi_id = Transaksi::get('id');
        // $rinci->transaksi_id = $request->get(Transaksi::get('id'));
        $rinci->transaksi_id = (int) $request->transaksi_id;
        $rinci->produk_id = $produk['id'];
        // pointing dengn produk id didlam modal
        // $rinci->kuantitas = $request[$kuantitas];
        $rinci->kuantitas = $request->kuantitas;
        $rinci->harga_id = $produk->harga;
        
        $rinci->save();
        
        
        // if (! $transaksi){
        //     return response()->json('Data Tidak Ada',400);
        // }

        // return response()->json('Data berhasil disimpan', 200);
        // return view('transaksi.tambah');
        // return redirect()->route('orderrinci.store');
        return redirect(route('orderrinci.store'))->with('success','Berhasil Disimpan');
        
    }

    public function cetak(string $id)
    {
        $data=Transaksi::with(['Pelanggan'])
        ->find($id);
        $rinci=Transaksirinci::where('transaksi_id',$id)->get();
        
        return view('transaksi.cetaknota')
        ->with('transaksi', $data)
        ->with('transaksirinci', $rinci);
        

    }

    public function data ($id)
    {   
        // dataTablerinci
        // return DataTables::of(Transaksirinci::query())->addIndexColumn()->toJson();
        $rinci = Transaksirinci::with('produk')
            ->where('transaksi_id',$id)
            ->get();
        // return $rinci;
        return datatables()
            ->of($rinci)
            ->addIndexColumn()
            ->addColumn('nama', function ($rinci){
                return $rinci->produk['nama'];
            })
            ->addColumn('kuantitas', function ($rinci){
                return $rinci->kuantitas;
            })
            ->addColumn('harga', function ($rinci){
                return(format_uang($rinci->produk['harga'])) ;
            })
            ->addColumn('subtotal', function ($rinci){
                return(format_uang($rinci->subtotal)) ;
            })
            ->addColumn('aksi', function ($id) {
                return '
                <div class="btn-group">
                    <button method="post" onclick="deleteData(`'. route('orderrinci.destroy', $id) .'`)" class="btn btn-sm btn-danger btn-flat">Hapus</button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
        
        
    }
    public function destroy($id)
    {
        $transaksi = Transaksirinci::find($id);
        // $detail    = Transaksirinci::where('transaksi_id', $transaksi->transaksi_id)->get();
        // foreach ($detail as $item) {
        //     $produk = Produk::find($item->id);
        //     if ($produk) {
        //         $produk->stok -= $item->jumlah;
        //         $produk->update();
        //     }
        //     $item->delete();
        // }

        $transaksi->delete();

        return response(null, 204);
    }
}
 