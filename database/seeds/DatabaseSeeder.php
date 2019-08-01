<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$users = [
    		[
    		'name' => 'admin',
        	'email' => 'admin@gmail.com',
        	'phone' => '0986.168.168',
        	'password' => bcrypt('123456'),
        	'position' => 'giamdoc',
        	'active' => '1',
        	'is_admin' => '1',
        	'created_at' => new Datetime(),
       		],[
        	'name' => 'Hoàng Phi',
        	'email' => 'hoangphi1301@gmail.com',
        	'phone' => '0986.666.888',
        	'password' => bcrypt('123456'),
        	'position' => 'giamdoc',
        	'active' => '1',
        	'is_admin' => '1',
        	'created_at' => new Datetime(),
    		],
    	];

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

    	$userpermit = [
    		[
    			'user_id' => '1',
    			'permit' => 'view-user',
    			'created_at' => new Datetime(),
    		],[
    			'user_id' => '1',
    			'permit' => 'create-user',
    			'created_at' => new Datetime(),
    		],[
    			'user_id' => '1',
    			'permit' => 'update-user',
    			'created_at' => new Datetime(),
    		],[
    			'user_id' => '1',
    			'permit' => 'delete-user',
    			'created_at' => new Datetime(),
    		],[
    			'user_id' => '2',
    			'permit' => 'view-user',
    			'created_at' => new Datetime(),
    		],[
    			'user_id' => '2',
    			'permit' => 'create-user',
    			'created_at' => new Datetime(),
    		],[
    			'user_id' => '2',
    			'permit' => 'update-user',
    			'created_at' => new Datetime(),
    		],[
    			'user_id' => '2',
    			'permit' => 'delete-user',
    			'created_at' => new Datetime(),
    		],
    	];

    	DB::table('users')->insert($users);
    	DB::table('user_profile')->insert($userprofile);
    	DB::table('user_permit')->insert($userpermit);
    }
}
