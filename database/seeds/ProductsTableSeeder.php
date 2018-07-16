<?php

use Illuminate\Database\Seeder;

use App\Product;
use App\TestProduct;
use App\ProductCategory;
use App\Purchases;
use App\Unit;
use App\PaymentType;

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
            
            // check if table users is empty
            if (Unit::get()->count() == 0) {
                Unit::insert([
                    ['name' => 'GR'],
                    ['name' => 'PCS'],
                    ['name' => 'ML'],
                    ['name' => 'LT']
                ]);
            }

            if (PaymentType::get()->count() == 0) {
                PaymentType::insert([
                    ['name' => 'CASH'],
                    ['name' => 'DEBIT'],
                    ['name' => 'CREDIT']
                ]);
            }
            
        }
    }
}