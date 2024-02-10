<?php

namespace App\Models\Transaksi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $guarded= ['id'];
    protected $table= 'pembayarans';
    public function Transaksi (){
        return $this->belongsTo(Transaksi::class);
    }
}
