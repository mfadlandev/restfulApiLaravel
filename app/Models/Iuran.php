<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Iuran extends Model
{
    protected $fillable = [
        'p_id',
        'tahun',
        'tanggal',
        'nominal',
        'payment',
        'status',
    ];

    public function Penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'p_id', 'p_id');
    }
}
