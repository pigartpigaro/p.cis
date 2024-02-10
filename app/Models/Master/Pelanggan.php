<?php

namespace App\Models\Master;

use App\Models\Transaksi\Transaksi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $guarded= ['id'];


    public function scopeFilter($query, array $filters)
    {

        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('nama','like', '%' . $search . '%')
                      ->orWhere('alamat','like', '%' . $search . '%')
                      ->orWhere('nohp','like', '%' . $search . '%');
        });
    }
    // protected $with =['produk'];
    protected $table= 'pelanggans';
    public function produk (){
        return $this->hasMany(Produk::class);
    }
    public function transaksi (){
        return $this->hasMany(Transaksi::class);
    }
}
