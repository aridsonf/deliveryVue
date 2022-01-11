<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function relOrder()
    {
        return $this->belongsTo(Orders::class, 'fk_order');
    }

    public function relStock()
    {
        return $this->belongsTo(Stock::class, 'fk_stock');
    }
}
