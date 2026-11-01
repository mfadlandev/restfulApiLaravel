<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banjar extends Model
{
    protected $primaryKey = 'banjar_id';

    protected $fillable = [
        'nama',
    ];

    public function Penduduk()
    {
        return $this->hasMany(Penduduk::class, 'banjar_id', 'banjar_id');
    }
}
