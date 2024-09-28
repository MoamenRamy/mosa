<?php

namespace Database\Seeders;

use App\Models\Goods_Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GoodsSupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Goods_Supplier::factory()->count(16)->create();
    }
}
