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
            'password'=> \Hash::make('12345')
        ]);

        Categories::create([
            'category_name' => 'Makanan'
        ]);

        Categories::create([
            'category_name' => 'Minuman'
        ]);

        Products::create([
            'product_code' => 'K001',
            'name' => 'Kusuka',
            'purchase_price' => '12000',
            'selling_price' => '20000',
            'stock' => '100',
            'image' => 'kusuka.jpg',
            'category_id' => 1,
        ]);

        Products::create([
            'product_code' => 'C002',
            'name' => 'Chitato',
            'purchase_price' => '10000',
            'selling_price' => '15000',
            'stock' => '25',
            'image' => 'Chitato.jpg',
            'category_id' => 1,
        ]);

        Products::create([
            'product_code' => 'C002',
            'name' => 'Chitato',
            'purchase_price' => '10000',
            'selling_price' => '15000',
            'stock' => '25',
            'image' => 'Chitato.jpg',
            'category_id' => 1,
        ]);

        Products::create([
            'product_code' => 'F003',
            'name' => 'FrenchFries',
            'purchase_price' => '13000',
            'selling_price' => '18000',
            'stock' => '35',
            'image' => 'FrenchFries.jpg',
            'category_id' => 1,
        ]);

        Products::create([
            'product_code' => 'K002',
            'name' => 'Kacang 2 Kelinci',
            'purchase_price' => '17000',
            'selling_price' => '25000',
            'stock' => '20',
            'image' => 'Kacang 2 Kelinci.jpg',
            'category_id' => 1,
        ]);

        Products::create([
            'product_code' => 'K003',
            'name' => 'Kuaci Rebo',
            'purchase_price' => '10000',
            'selling_price' => '14000',
            'stock' => '29',
            'image' => 'Kuaci Rebo.jpg',
            'category_id' => 1,
        ]);

        Products::create([
            'product_code' => 'P001',
            'name' => 'Popcorn',
            'purchase_price' => '10000',
            'selling_price' => '14000',
            'stock' => '60',
            'image' => 'Popcorn.jpg',
            'category_id' => 1,
        ]);

        Products::create([
            'product_code' => 'Q001',
            'name' => 'Qtela',
            'purchase_price' => '14000',
            'selling_price' => '24000',
            'stock' => '70',
            'image' => 'Qtela.jpg',
            'category_id' => 1,
        ]);

        Products::create([
            'product_code' => 'T001',
            'name' => 'Tictac',
            'purchase_price' => '10000',
            'selling_price' => '16000',
            'stock' => '35',
            'image' => 'Tictac.jpg',
            'category_id' => 1,
        ]);

        Products::create([
            'product_code' => 'T002',
            'name' => 'Twisku',
            'purchase_price' => '11000',
            'selling_price' => '15000',
            'stock' => '45',
            'image' => 'Twisku.jpg',
            'category_id' => 1,
        ]);

        Products::create([
            'product_code' => 'B002',
            'name' => 'Bearbrand',
            'purchase_price' => '8000',
            'selling_price' => '13000',
            'stock' => '50',
            'image' => 'bear.jpg',
            'category_id' => 2,
        ]);

        Products::create([
            'product_code' => 'C004',
            'name' => 'Cimory Yougrt',
            'purchase_price' => '12000',
            'selling_price' => '15000',
            'stock' => '50',
            'image' => 'cimory.jpg',
            'category_id' => 2,
        ]);

        Products::create([
            'product_code' => 'F002',
            'name' => 'Fanta Merah',
            'purchase_price' => '5000',
            'selling_price' => '8000',
            'stock' => '50',
            'image' => 'fanta.jpg',
            'category_id' => 2,
        ]);

        Products::create([
            'product_code' => 'O002',
            'name' => 'Olate',
            'purchase_price' => '8000',
            'selling_price' => '13000',
            'stock' => '40',
            'image' => 'olate.jpg',
            'category_id' => 2,
        ]);

        Products::create([
            'product_code' => 'P003',
            'name' => 'Teh Pucuk Harum',
            'purchase_price' => '4000',
            'selling_price' => '6000',
            'stock' => '100',
            'image' => 'pucuk.jpg',
            'category_id' => 2,
        ]);

        Products::create([
            'product_code' => 'S002',
            'name' => 'Sprite',
            'purchase_price' => '3000',
            'selling_price' => '5000',
            'stock' => '50',
            'image' => 'sprite.jpg',
            'category_id' => 2,
        ]);

        Products::create([
            'product_code' => 'Y002',
            'name' => 'Yakult',
            'purchase_price' => '8000',
            'selling_price' => '12000',
            'stock' => '50',
            'image' => 'yakult.jpg',
            'category_id' => 2,
        ]);
    }
}
