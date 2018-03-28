<?php

use Illuminate\Database\Seeder;

use App\Product;
use App\TestProduct;
use App\ProductCategory;
use App\Purchases;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {

		$faker = \Faker\Factory::create();
		
        // Create 8 product records
        for ($i = 0; $i < 10; $i++) {
			// TestProduct::create([
				//     'title' => $faker->sentence($nbWords = 4, $variableNbWords = true),
				//     'description' => $faker->paragraph,
				//     'price' => $faker->randomNumber(2),
				//     'availability' => $faker->boolean(50)
				// ]);
				
			// ProductCategory::create([
			// 	'name' => str_replace('.', '', $faker->name),
			// ]);
					
			// $name = $faker->name;
			// $name = str_replace('.', '', $name);
            // Product::create([
			// 	'name' => strtoupper($name),
            //     'pack_size' => $faker->randomNumber(2),
            //     // 'key' => strtoupper(str_replace(' ', '_', $name)),
            //     'category_id' => $faker->randomDigitNotNull(1),
            //     'unit_id' => $faker->randomNumber(2),
			// ]);
			
            Purchases::create([
				'product_id' => $faker->randomDigitNotNull(1),
                'unit_price' => $faker->randomNumber(6),
                'qty' => $faker->randomNumber(1),
                'qty' => $faker->randomNumber(1),
            ]);
            
        }
    }
}