<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LaporanController extends Controller
{
    public function data()
    {
        return DataTables::of(Laporan::query())->addIndexColumn()->toJson();
    }

    public function index()
    {
        return view('laporan');
    }
    public function store(Request $request){
        $data=Laporan::create([
            'nama'=> $request->nama,
            'satuan'=> $request->satuan,
            'harga'=> $request->harga,
            'keterangan'=> $request->keterangan,
        ]);
        return response()->json($data);
    }
}
