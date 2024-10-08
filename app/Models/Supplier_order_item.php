<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier_order_item extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

   public function supplier_order()
   {
     return $this->belongsTo(Supplier_order::class);
   }

   public function goods()
    {
        return $this->belongsTo(Goods::class);
    }
}
