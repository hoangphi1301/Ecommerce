<?php

use Illuminate\Database\Seeder;

class UserPermitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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

    	DB::table('user_permit')->insert($userpermit);
    }
}
