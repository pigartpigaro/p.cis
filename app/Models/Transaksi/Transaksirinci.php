<?php

namespace App\Models\Transaksi;

use App\Models\Master\Produk;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksirinci extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    protected $table = 'transaksirincis';
    protected $dates = ['deleted_at'];
    protected $appends = array ('subtotal');
    public function getSubtotalAttribute()
    {
        return $this->kuantitas*$this->produk->harga;
    }
    public function scopeFilter($query, array $filters)
    {

        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('transaksi_id','like', '%' . $search . '%')
                      ->orWhere('total','like', '%' . $search . '%')
                      ;
        });
    }


    public function produk (){
        return $this->belongsTo(Produk::class);
    }
    public function transaksi (){
        return $this->belongsTo(Transaksi::class);
    }
}
