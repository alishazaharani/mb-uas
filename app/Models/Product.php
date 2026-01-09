<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';
    protected $fillable = [
        'name',
        'price',
        'image',
        'stock',
        'description',
        'kategori_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }

    public function orders()
    {
        return $this->hasMany(OrderModel::class);
    }

    public function carts()
    {
        return $this->hasMany(CartModel::class);
    }
}
