<?php

namespace Database\Seeders;

use App\Models\Supplier_order_item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Supplier_order_itemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier_order_item::factory()->count(4000)->create();
    }
}
