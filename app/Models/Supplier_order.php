<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier_order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function supplier_order_items()
    {
        return $this->hasMany(Supplier_order_item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
