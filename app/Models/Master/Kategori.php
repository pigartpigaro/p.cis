<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $guarded= ['id'];

    public function scopeFilter($query, array $filters)
    {

        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('nama','like', '%' . $search . '%');
        });
    }
    protected $table= 'kategoris';
    public function produk (){
        return $this->belongsTo(Produk::class);
    }

}
