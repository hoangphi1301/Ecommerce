<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
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

    	DB::table('users')->insert($users);
    }
}
