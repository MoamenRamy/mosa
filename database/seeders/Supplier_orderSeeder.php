<?php

namespace Database\Seeders;

use App\Models\Supplier_order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Supplier_orderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier_order::factory()->count(4)->create();
    }
}
