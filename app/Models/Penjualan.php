<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $fillable = [
        'roti_id',
        'tanggal_penjualan',
        'jumlah_terjual',
        'total_harga'
    ];

    public function roti()
    {
        return $this->belongsTo(Roti::class);
    }
}