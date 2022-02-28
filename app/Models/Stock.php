<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function relProducts()
    {
        return $this->belongsTo(Products::class, 'fk_product');
    }

    public function relItems()
    {
        return $this->hasMany(OrderItems::class, 'fk_stock');
    }
}
