<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CacheController extends Controller
{

    //重置opcache换成
    public function opcache_reset(){
        //opache开启
        if(function_exists('opcache_reset')){
            $result = opcache_reset();
            if($result){
                return resposen()->json(null,204);
            }
        }

        return response()->json(null,400);

    }

}
