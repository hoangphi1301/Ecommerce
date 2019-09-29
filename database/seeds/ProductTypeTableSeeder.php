<?php

use Illuminate\Database\Seeder;

class ProductTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $producttypes = [
            [
                'name'=>'Laptop',
            ],[
                'name'=>'Smartphone',
            ],[
                'name'=>'Smartwatch'
            ],[
                'name'=>'Tai nghe'
            ],[
                'name'=>'Loa'
            ],[
                'name'=>'Phụ kiện'
            ]
        ];

        DB::table('product_types')->insert($producttypes);

    }
}
