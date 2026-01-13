<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'pesanan_id', 'product_id', 'qty', 'price'
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class); // Relasi ke pesanan
    }

    public function product()
    {
        return $this->belongsTo(Product::class); // Relasi ke produk
    }
}
