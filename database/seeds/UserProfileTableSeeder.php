<?php

use Illuminate\Database\Seeder;

class UserProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $userprofile = [
    		[
    		'user_id' => '1',
        	'birthday' => '1996-01-01',
        	'address' => 'Hà Nội',
        	'sex' => '1',
        	'description' => '',
        	'avatar' => 'avatar_01.jpg',
        	'created_at' => new Datetime(),
    		],[
    		'user_id' => '2',
        	'birthday' => '1991-01-13',
        	'address' => 'Hải Dương',
        	'sex' => '1',
        	'description' => '',
        	'avatar' => 'avatar_02.jpg',
        	'created_at' => new Datetime(),
    		],
    	];

    	DB::table('user_profile')->insert($userprofile);
    }
}
