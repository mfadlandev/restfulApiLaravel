<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'outlet_id',
        'category_id',
        'name',
        'description',
        'price',
        'img',
        'stock',
        'slug',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'stock' => 'integer',
        ];
    }

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }

    public function category()
    {
        return $this->belongsTo(
            Category::class,
            'category_id',
            'category_id'
        );
    }

    public function transactionDetails()
    {
        return $this->hasMany(
            TransactionDetail::class,
            'product_id',
            'product_id'
        );
    }
}
