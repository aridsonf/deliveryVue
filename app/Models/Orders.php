<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function relUser()
    {
        return $this->belongsTo(User::class, 'fk_user');  
    }

    public function relItem()
    {
        return $this->hasMany(OrderItems::class, 'fk_order');
    }
}
