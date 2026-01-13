<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'total', 'payment_method', 'status'
    ];

    public function details()
    {
        return $this->hasMany(PesananDetail::class);
    }
}
