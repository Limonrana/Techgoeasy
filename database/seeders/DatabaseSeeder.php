<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // Crate Super Admin
        User::factory()->create([
            'name' => 'Limon Rana',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Admin@1122'),
            'is_super' => true
        ]);

        // Create Uncategorized category
        Category::factory()->create([
            'name' => 'Uncategorized',
            'slug' => 'uncategorized',
            'created_by' => 1,
            'updated_by' => 1
        ]);
    }
}
