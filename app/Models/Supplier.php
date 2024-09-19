<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function goods()
    {
        return $this->hasMany(Goods::class, 'goods_suppliers', 'supplier_id', 'goods_id');
    }

    public function supplier_orders()
    {
        return $this->hasMany(Supplier_order::class);
    }
}
