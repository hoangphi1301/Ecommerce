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
    	$this->call(UserTableSeeder::class);
    	$this->call(UserProfileTableSeeder::class);
    	$this->call(UserPermitTableSeeder::class);
        $this->call(ProductTypeTableSeeder::class);
        $this->call(BrandTableSeeder::class);
        $this->call(ColorTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(DetailProductTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
    }
}
