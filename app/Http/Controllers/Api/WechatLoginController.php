<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\SocialAccount;
use App\Models\User;

class WechatLoginController extends Controller
{
    private $appid;
    private $secret;

    public function __construct(){
        $this->appid = config('services.wechat.appid');
        $this->secret = config('services.wechat.secret');
    }

    public function login(Request $request){
        // if($request->code){
        //     return ;
        // }

        // $gateway_url = $this->url($request->code);
        // $response = Http::get($gateway_url);

        // if($response->errcode == 0){
        //     $openid = $response->openid;
        //     $session_key = $response->session_key;
        //     $account = SocialAccount::where('platform','wechat')->where('openid',$openid)->first();
        //     if(!$account){
        //         $account = SocialAccount::autoCreate([
        //             'openid' => $openid,
        //             'platform' => 'wechat',
        //         ]);
        //     }

        // }

        // $user = User::where('user_id',$account->user_id)->with(['favorite_articles','history'])->first();
        $user = User::first();
        $token = $user->createToken('userToken')->accessToken;

        $data = [
            'user' => $user,
            'token' => $token,
        ];
        return response()->json($data);

    }

    protected function url($code){
        if(empty($this->appid) || empty($this->secret)){

        }
        
        $url = "https://api.weixin.qq.com/sns/jscode2session?appid=".$this->appid."&secret=".$this->secret."&js_code=".$code."&grant_type=authorization_code";

        return $url;
    }

    
}
