<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Support\Wechat\Auth as WechatAuth;
use App\Models\SocialAccount;

class WechatController extends Controller
{
    protected $auth;

    public function __construct(WechatAuth $auth){
        $this->auth = $auth; 
    }
   
    public function login(){
        return $this->auth->redirect();
    }

    public function callback(Request $request){
        $code = $request->code;
        if(!$code){
            //
        }
        $response = $this->auth->callback($code);

        $openid = $response['open_id'];
        $token = $response['access_token'];

        $user_info = $this->auth->getUserInfo($openid,$token);

        if($user_info['errorcode']=='41001'){
            //登录失效，重新登录
            return;
        }

        $data =[
            'platform'=>'wechat',
            'openid'=>$user_info['openid'],
            'openname'=>$user_info['nickname'],
            'avatar'=>$user_info['headimgurl'],
        ];

        $account = SocialAccount::where('platform','wechat')->where('openid',$user_info['openid'])->first();

        if(!$account){
            $account = SocialAccount::autoCreate($data);
        }else{
            //更新
            $account->openname = $user_info['nickname'];
            $account->avatar = $user_info['headimgurl'];
            $account->save();
        }
        


        $user = User::find($account->user_id);

        auth()->login($user);


    }

}
