<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(JobTitleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(GoodsSeeder::class);
        $this->call(HotelSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(Order_itemSeeder::class);
        // $this->call(GoodsSupplierSeeder::class);
        $this->call(Supplier_orderSeeder::class);
        $this->call(Supplier_order_itemSeeder::class);
    }
}
