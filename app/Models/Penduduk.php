<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    protected $primaryKey = 'p_id';

    protected $fillable = [
        'NIK',
        'nama',
        'JK',
        'TTL',
        'banjar_id',
    ];

    public function Banjar()
    {
        return $this->belongsTo(Banjar::class, 'banjar_id', 'banjar_id');
    }
}
