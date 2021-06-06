<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'key' => 'app.name',
                'value' =>'',
                'description'=>''
            ],
            [
                'key' => 'app.logo',
                'value' =>'',
                'description'=>''
            ],
            [
                'key' => 'app.slogan',
                'value' =>'',
                'description'=>''
            ],
            [
                'key' => 'app.qrcode',
                'value' =>'',
                'description'=>''
            ],
            [
                'key' => 'app.about',
                'value' =>'',
                'description'=>''
            ],
            [
                'key' => 'app.commentable',
                'value' =>'1',
                'description'=>'整站评论功能: 0关闭 1开启'
            ],
        ];

        foreach($data as $item){
            Setting::create($item);
        }


    }
}
