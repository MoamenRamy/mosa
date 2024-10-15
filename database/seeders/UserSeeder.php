<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory()->count(4)->create();
        $admin = User::create([
            'name' => 'علي',
            'email' => 'ali.mosa@gmail.com',
            'password' => 'Test1111#',
            'role' => 3,
        ]);
    }
}
