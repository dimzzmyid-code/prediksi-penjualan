<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roti extends Model
{
    protected $fillable = [
        'nama_roti',
        'harga',
        'stok'
    ];

    public function penjualans()
    {
        return $this->hasMany(Penjualan::class);
    }

    public function prediksis()
    {
        return $this->hasMany(Prediksi::class);
    }
}