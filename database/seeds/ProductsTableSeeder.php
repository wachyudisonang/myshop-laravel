<?php

use Illuminate\Database\Seeder;

use App\TestProduct;
use App\ProductCategory;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {

        $faker = \Faker\Factory::create();

        // Create 8 product records
        for ($i = 0; $i < 8; $i++) {
            // TestProduct::create([
            //     'title' => $faker->sentence($nbWords = 4, $variableNbWords = true),
            //     'description' => $faker->paragraph,
            //     'price' => $faker->randomNumber(2),
            //     'availability' => $faker->boolean(50)
            // ]);
            
            ProductCategory::create([
                'Name' => $faker->sentence($nbWords = 4, $variableNbWords = true),
            ]);
        }
    }
}