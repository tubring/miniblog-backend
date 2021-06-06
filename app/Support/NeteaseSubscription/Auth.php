<?php
namespace App\Support\NeteaseSubscription;

class Auth{

    private $client_id;

    private $client_secret;

    public function __construct($client_id,$client_secret){
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
    }

    public function authorize($redirect_url){
        $url = "https://mp.163.com/oauth2/authorize?client_id={$this->client_id}&response_type=code&redirect_uri={$redirect_url}";
        $res = file_get_contents($url);
        
    }

    public function code(){
        $code = request()->code;

        $url = "https://mp.163.com/oauth2/access_token?client_id={$this->client_id}&client_secret={$this->client_secret}&grant_type=authorization_code&code={$code}";

        $res = $this->httpPost($url);

    }

    protected function httpPost($url){
        
    }

    
}