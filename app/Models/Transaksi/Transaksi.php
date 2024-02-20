<?php

namespace App\Models\Transaksi;

use App\Models\Master\Pelanggan;
use App\Models\Master\Produk;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $guarded= ['id'];
    protected $table= 'transaksis';

    protected $appends = array('total');
    public function getTotalAttribute()
    {
        return $this->transaksirinci->sum('subtotal');
    }

    public function total()
    {
        return $this->produks->map(function ($p){
            return $p->harga;
        })->sum();
    }
    // public function formattedTotal()
    // {
    //     return number_format($this->total(), 2);
    // }
    public function scopeFilter($query, array $filters)
    {

        // $query->when($filters['transaksi'] || $filters['pelanggan'] ?? false, function($query, $search) use ($filters) {
        //     $transaksi = $filters['transaksi'] ? $filters['transaksi'] : '';
        //     $pelanggan = $filters['pelanggan'] ? $filters['pelanggan'] : ''; 
        //     return $query->whereHas('transaksi', function ($q) use ($transaksi){
        //         $q->where('no_nota', 'like', '%' . $transaksi . '%');
        //     })->whereHas('pelanggan', function ($q) use ($pelanggan) {
        //         $q->where('nama', 'like', '%' . $pelanggan . '%');
        //     });
        // });   

            
        // $search->when($filters['cari'] ?? false, function ($search, $query) {
        //     return $search->whereHas('transaksi', function ($cari) use ($query) {
        //         $cari->where('no_nota', 'like', '%' . $query . '%');
        //     })->orWhereHas('pelanggan', function ($cari) use ($query) {
        //         $cari->where('nama', 'like', '%' . $query . '%');
        //     });
        // });


        // $query->when($filters['cari'] ?? false, function($query, $search) {
        //     return $query->whereHas('transaksi', function($cari) use ($search){
        //         $cari->where('no_nota','like', '%' . $search . '%')
        //                 ->orWhere('tanggal','like', '%' . $search . '%'); 
        //     })
        //     ->orWhereHas('pelanggan', function($cari) use ($search){
        //         $cari->where('nama','like', '%' . $search . '%');
        //     });       
        // });     


        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('no_nota','like', '%' . $search . '%')
                      ->orWhere('tanggal','like', '%' . $search . '%');
        });


        
    }
    
    public function pelanggan (){
        return $this->belongsTo(Pelanggan::class);
    }
    
    public function transaksirinci (){
        return $this->hasMany(Transaksirinci::class);
    }
    
}
