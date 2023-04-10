<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Categories;
use App\Models\Products;

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
        User::create([
            'name'  => 'testing',
            'email' => 'testing1@gmail.com',
            'password' => 12345
        ]);

        Categories::create([
            'category_name' => 'Makanan'
        ]);

        Categories::create([
            'category_name' => 'Minuman'
        ]);

        Products::create([
            'product_code' => 'K001',
            'name' => 'Kopi Kapal Api',
            'purchase_price' => '12000',
            'selling_price' => '20000',
            'stock' => '100',
            'image' => 'public/img/avatar5.png',
            'category_id' => 1,
        ]);
    }
}
