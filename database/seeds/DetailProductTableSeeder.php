<?php

use Illuminate\Database\Seeder;

class DetailProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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

        DB::table('detail_product')->insert($detailproduct);
    }
}
