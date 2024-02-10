<?php

namespace App\Models\Master;

use App\Models\Transaksi\Transaksirinci;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $guarded= ['id'];
    protected $with = ['kategori', 'satuan'];

    // protected $appends = array ('nilai');
    // public function getNilaiAttribute()
    // {
    //     return $this->calculateNilai();
    // }

    public function scopeFilter($query, array $filters)
    {

        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('nama','like', '%' . $search . '%')
                      ->orWhere('harga','like', '%' . $search . '%')
                      ;
        });
        $query->when($filters['kategori'] ?? false, function($query, $kategori) {
            return $query->where('kategori', function($query) use ($kategori){
                $query->where('nama','like','%' . $kategori . '%');
            });
        });
    }

    public function rupiah ($angka) {
        $hasil = 'Rp ' . number_format($angka, 2, ".", ",");
        return $hasil;
    }
    protected $table= 'produks';
    public function satuan (){
        return $this->belongsTo(Satuan::class);
    }
    public function kategori (){
        return $this->belongsTo(Kategori::class);
    }
    // public function transaksirinci (){
    //     return $this->hasMany(Transaksirinci::class);
    // }
}
