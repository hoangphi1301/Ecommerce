<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
        	[
        		'name'=>'Laptops',
        		'image'=>'category_laptop.jpg'
        	],
        	[
        		'name'=>'Smartphone',
        		'image'=>'category_smartphone.jpg'
        	],
        	[
        		'name'=>'SmartWatch',
        		'image'=>'category_smartwatch.jpg'
        	],
        	[
        		'name'=>'Tablet',
        		'image'=>'category_tablet.jpg'
        	],
        	[
        		'name'=>'Phụ kiện',
        		'image'=>'category_headphone.jpg'
        	],
        ];

        DB::table('categories')->insert($category);
    }
}
