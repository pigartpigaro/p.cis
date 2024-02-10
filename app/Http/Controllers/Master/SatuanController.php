<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('master.satuan.satuan', [
            'satuan'=>Satuan::latest()
            ->filter(request(['search']))
            ->paginate(5)->withQueryString()
            
    ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('master.satuan.postsatuan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request -> validate([
            'nama' => 'required|unique:satuans|max:255',
            
        ]);
        $validator['id'] = auth()->user()->id;

        // if(!$validator){
        //     return redirect('/satuan')->with('invalid','Gagal Disimpan');
        // }
        Satuan::create($validator);
        return redirect('/satuan')->with('success','Berhasil Disimpan');       
        // $data=Pelanggan::create([
        //     'nama'=> $request->nama,
        //     'alamat'=> $request->alamat,
        //     'nohp'=> $request->nohp,
        // ]);
        // $data->save();
        // return redirect('/pelanggan')->with(['success' => 'Post Successfully Created']);
        // return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // return view('customer.pelanggan',[
        //     'pelanggan' => $id
        // ]);
            
        // return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(satuan $satuan)
    {
        return view('master.satuan.edit',[
            'satuan' => $satuan,
            'satuans' => Satuan::all()
        ]);
        // $data = Satuan::select('*')
        //      ->where('id', $id)
        //      ->get();

        // return view('master.satuan.satuan', ['satuan' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $request = Pelanggan::where('id',$request->id)
        // ->update([
        //     'nama' => 'required|max:255',
        //     'alamat' => 'max:255',
        //     'nohp' => 'required|numeric',
        // ]);
        
        $validator = $request -> validate([
            'nama' => 'required|max:255',
            
        ]);
        $validator['id'] = auth()->user()->id;
        Satuan::find($id)
        ->update($validator);
        

        // $edit = Pelanggan::find($id);
        // $edit->update($request->all());
        return redirect('/satuan')->with('success', 'Edit Berhasil.');


        // $data=Pelanggan::find($request->id);
        // if(!$data){
        //     return response()->json('NotValid',500);
        // }
        // $data->update([
        //     'nama'=> $request->nama,
        //     'alamat'=> $request->alamat,
        //     'nohp'=> $request->nohp,
        // ]);

        // return response()->json('Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Pelanggan::destroy($request->id);
        $data=Satuan::find($id);
        // if(!$data){
            //     return response()->json('NotValid',500);
            // }
        $data->delete();
        return redirect('/satuan')->with('success','Berhasil Dihapus');

        // return response()->json('Success');
    }
}
