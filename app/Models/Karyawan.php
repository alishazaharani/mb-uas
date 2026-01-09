<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $fillable = ['user_id', 'jabatan', 'tanggal_masuk'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

