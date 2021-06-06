<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function getConfig(){
        $settings = Setting::all();

        $config=[];
        foreach($settings as $setting){
            $config[$setting->key]=$setting->value;
        }

        return $config;
    }
}
