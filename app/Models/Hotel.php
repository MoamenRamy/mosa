<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $dates = ['last_supply_date'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
