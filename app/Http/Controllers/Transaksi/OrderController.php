<?php

namespace App\Http\Controllers\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\Kategori;
use App\Models\Master\Pelanggan;
use App\Models\Master\Produk;
use App\Models\Transaksi\Transaksi;
use App\Models\Transaksi\Transaksirinci;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $pelanggan = Pelanggan::all();
        // $transaksi = Transaksi::all();
       
        
        
        $pelanggan = Pelanggan::orderBy('nama')->get();
        // $transaksi = Transaksi::all();
        $transaksi = Transaksi::all();
        // ->filter(request(['cari']))
        // ->with('pelanggan')
        // ->paginate(10)->withQueryString();

        $transaksirinci = Transaksirinci::all();
        $produk = Produk::all();
        return view('transaksi.order', compact('pelanggan','transaksi','transaksirinci','produk'));
        
        // return view('transaksi.order', [
        //     Transaksi::with('transaksirinci', 'pelanggan')->latest()
            
            
        //     ->filter(request(['search','transaksi','transaksirinci','pelanggan']))
        //     ->paginate(10)->withQueryString()
        // ]);
    }
    public function pelangganbaru(Request $request)
    {
        $validator = $request -> validate([
            'nama' => 'required|min:3|max:255',
            'alamat' => 'max:255',
            'nohp' => 'required|min:5|numeric',
        ]);
        $validator['id'] = auth()->user()->id;

        
        Pelanggan::create($validator);
        return redirect()->route('order.index');       
        
    }
    public function cetak(string $id)
    {
        $data=Transaksi::with(['Pelanggan'])
        ->find($id);
        $rinci=Transaksirinci::where('transaksi_id',$id)->get();
        
        return view('transaksi.cetak')
        ->with('transaksi', $data)
        ->with('transaksirinci', $rinci);
        

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $order = new Transaksi();
        $order->pelanggan_id = $id;
        $order->no_nota = self::buatnomor();
        $order->tanggal = self::buattanggal();
        $order->time = self::time();

        $order->save();
       
        session(['transaksi'=> $order->id]);
        session(['pelanggan_id'=> $order->pelanggan_id]);

        return redirect()->route('orderrinci.index');
        // $pelanggans = Pelanggan::all();
        // $produks = Produk::all();
        
        // return view('transaksi.tambah', compact('pelanggans','produks'));
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order = Transaksi::findOrFail($request->id);
        $order->update();

        $rinci = Transaksirinci::where('transaksi_id', $order->id)->get();
        foreach ($rinci as $item){
            $produk = Produk::find($item->id);
            $produk->update();
        }
        return redirect()->route('order.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data=Transaksi::with(['Pelanggan'])
        ->find($id);
        $rinci=Transaksirinci::where('transaksi_id',$id)->get();
        
        return view('transaksi.view')
        ->with('transaksi', $data)
        ->with('transaksirinci', $rinci);
        

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // return view('transaksi.edit',[
        //     'produk' => $produk,
        //     'kategoris' => Produk::all(),
        //     'pelanggan' => Pelanggan::orderBy('nama')->get()
        // ]);
        
        $transaksi_id = session('transaksi');
        $pelanggan = Pelanggan::orderBy('nama')->first();
        $transaksi=Transaksi::with(['Pelanggan'])
        ->find($id);
        $transaksirinci = Transaksirinci::where('transaksi_id',$id)->get();
        $produks = Produk::all();
        return view('transaksi.edit', compact('pelanggan','transaksi','transaksirinci','produks'));
        // return Redirect::route('orderrinci.store')
        // ->with('pelanggan', $pelanggan)
        // ->with('transaksi', $transaksi)
        // ->with('transaksirinci', $transaksirinci)
        // ->with('produks', $produks);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data=Transaksi::find($id);
        // if(!$data){
            //     return response()->json('NotValid',500);
            // }
        $data->delete();
        return redirect('/order')->with('success','Berhasil Dihapus');
    }
    public static function buatnomor(){
        $huruf = ('NAMI'); 
        
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('d');
        // $time = date('mis');
        // $nomer=Transaksi::latest();
        $cek = Transaksi::count();
        if ($cek == null){
            $urut = "0001";
            $sambung = $tgl.strtoupper($huruf).$urut;
        }
        else{
            $ambil=Transaksi::all()->last();
            $urut = (int)substr($ambil->no_nota, 7, 4) + 1;
            //cara menyambungkan antara tgl dn kata dihubungkan tnda .
            // $urut = "000" . $urut;
            if(strlen($urut) == 1){
                $urut = "000" . $urut;
            }
            else if(strlen($urut) == 2){
                $urut = "00" . $urut;
            }
            else if(strlen($urut) == 1){
                $urut = "0" . $urut;
            }
            else {
                $urut = (int)$urut;
            }
            $sambung = $tgl.strtoupper($huruf).$urut;
        }
        
        return $sambung;
    }
    //cara buat tanggal
    public static function buattanggal(){
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d');
        return $tanggal;

    }
    public static function time(){
        date_default_timezone_set('Asia/Jakarta');
        $time = date('H:i');
        return $time;

    }
    public function status($id){
        $data=Transaksi::where('id',$id)->first();
        $aktif = $data->status;
        if($aktif == 1){
            Transaksi::where('id',$id)->update([
                'status'=>0
            ]);
        }else{
            Transaksi::where('id',$id)->update([
                'status'=>1
            ]);
        }
        // \Session()->flash('sukses','Status Berhasil diubah');
        return redirect('/order');
    }
}