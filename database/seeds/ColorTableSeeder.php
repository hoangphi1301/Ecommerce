<?php

use Illuminate\Database\Seeder;

class ColorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            [
                'name'=>'Black',
                'code'=>'#000000'
            ],
            [
                'name'=>'White',
                'code'=>'#FFFFFF'
            ],
            [
                'name'=>'Gold',
                'code'=>'#ffd700'
            ],
            [
                'name'=>'RoseGold',
                'code'=>'#B76E79'
            ],
            [
                'name'=>'Pink',
                'code'=>'#ffc0cb'
            ],
        ];

        DB::table('colors')->insert($colors);
    }
}
