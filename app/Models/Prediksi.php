<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prediksi extends Model
{
    protected $fillable = [
    'roti_id',
    'periode_prediksi',
    'hasil_prediksi',
    'nilai_a',
    'nilai_b'
];

public function roti()
{
    return $this->belongsTo(Roti::class);
}

}
