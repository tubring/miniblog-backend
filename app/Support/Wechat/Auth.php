<?php
namespace App\Support\Wechat;

class Auth {
    
    private $appid;

    private $secrect;

    private $redirect_uri;

    public function __construct(){
        $this->appid = config('services.wechat.appid');
        $this->secret = config('services.wechat.secret');
        $this->redirect_uri = config('services.wechat.redirect_uri');
    }

    //
    public function redirect($url=""){
        if($url){
            $this->reirect_uri = $url;
        }
        $redirect_uri = urlencode($this->reirect_uri);
        $state = md5(time());
        $url = "https://open.weixin.qq.com/connect/qrconnect?appid=$this->appid&redirect_uri=$redirect_uri&response_type=code&scope=SCOPE&state=$state#wechat_redirect";
        $res = file_get_contents($url);
        return $res;
    }

    public function callback($code){
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$this->appid&secret=$this->secret&code=$code&grant_type=authorization_code";
        $response = $this->post($url);
        return json_decode($response,true);
    }

    public function getUserInfo($openid,$token){
        $user_info_url = "https://api.weixin.qq.com/sns/userinfo?access_token=$token&openid=$openid";
        $response = $this->post($user_info_url);
        return json_decode($response,true);
    }

    protected function post($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $rst = curl_exec($ch);
        curl_close($ch);
        return $rst;
    }

}