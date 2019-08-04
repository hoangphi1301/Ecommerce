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

        $detailproduct = [
            [
                'product_id'=>'1',
                'size'=>'158.5 x 74.5 x 7.7mm',
                'weight'=>'',
                'display'=>'sAMOLED FHD+ 6.4 inches',
                'resolution'=>'1080 x 2220 pixels',
                'system'=>'Android',
                'storage'=>'128GB',
                'ram'=>'6GB',
                'cpu'=>'Samsung Exynos 9 Octa 9610',
                'gpu'=>'Mali-G72 MP3',
                'camera'=>'25MP AF (F1.7) + 5MP FF (F2.2) + 8MP FF (F2.4)',
                'bluetooth'=>'',
                'wlan'=>'Yes Wi-Fi 802.11, b/g/n',
                'gps'=>'A-GPS',
                'port'=>'',
                'battery'=>'4,000 mAh',
                'other'=>'Vân tay trên màn hình'
            ], [
                'product_id'=>'2',
                'size'=>'143.6 x 70.9 x 7.7 mm',
                'weight'=>'177 gram',
                'display'=>'Super Retina OLED',
                'resolution'=>'1125 x 2436 pixels',
                'system'=>'iOS',
                'storage'=>'64GB',
                'ram'=>'4GB',
                'cpu'=>'Apple A12 Bionic 6 nhân',
                'gpu'=>'Apple GPU 4 nhân',
                'camera'=>'Sau: 12 MP, Trước: 7 MP',
                'bluetooth'=>'LE, A2DP, v5.0',
                'wlan'=>'Wi-Fi 802.11 a/b/g/n/ac, Dual-band, Wi-Fi hotspot',
                'gps'=>'A-GPS, GLONASS',
                'port'=>'',
                'battery'=>'Li-po',
                'other'=>'LTE-A (6CA) Cat18 1200/200 Mbps, Face ID'
            ],
        ];

    	DB::table('users')->insert($users);
    	DB::table('user_profile')->insert($userprofile);
    	DB::table('user_permit')->insert($userpermit);
        DB::table('product_types')->insert($producttypes);
        DB::table('brands')->insert($brands);
        DB::table('colors')->insert($colors);
        DB::table('products')->insert($products);
        DB::table('detail_product')->insert($detailproduct);
    }
}
