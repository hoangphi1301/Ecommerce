<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'product_type_id'=>'2',
                'brand_id'=>'1',
                'color_id'=>'1',
                'name'=>'Galaxy S10 Plus',
                'price'=>'28000',
                'promotion_price'=>'24000',
                'image'=>'galaxy_s10.jpg',
                'description'=>'Điện thoại cao cấp của Samsung',
                'amount'=>'10'
            ], [
                'product_type_id'=>'2',
                'brand_id'=>'2',
                'color_id'=>'2',
                'name'=>'iPhone XS',
                'price'=>'32000',
                'promotion_price'=>'0',
                'image'=>'iphone_XS.jpg',
                'description'=>'Điện thoại cao cấp của Apple',
                'amount'=>'8'
            ],
        ];

        DB::table('products')->insert($products);
    }
}
