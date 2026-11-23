<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone',
    ];

    // Outlet memiliki banyak user
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Outlet memiliki banyak kategori
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    // Outlet memiliki banyak produk
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Outlet memiliki banyak transaksi
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
