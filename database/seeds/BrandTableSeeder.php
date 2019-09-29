<?php

use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
            [
                'name'=>'Samsung',
                'description'=>'Công ty của Hàn Quốc'
            ],[
                'name'=>'Apple',
                'description'=>'Công ty của Mỹ'
            ],[
                'name'=>'Nokia',
                'description'=>'Công ty của Phần Lan'
            ],[
                'name'=>'Dell',
                'description'=>'Công ty của Mỹ'
            ],[
                'name'=>'HP',
                'description'=>'Công ty của Mỹ'
            ],[
                'name'=>'Asus',
                'description'=>'Công ty của Đài Loan'
            ],
        ];

        DB::table('brands')->insert($brands);
    }
}
