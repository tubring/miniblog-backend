@extends('home.layouts.master')

@section('content')
    <div class="bg-white rounded shadow p-6 md:p-7 lg:p-9">
        @include('home.layouts._alert')

        <div class="w-full border-b boder-dotted border-gray-300 pb-5 my-5 text-xl font-bold text-center">微信扫码登录</div>

        <div class="w-full text-center">
            <div id="login_container" class=""></div>
        </div>

        <input type="hidden" name="appid" value="{{$appid}}">
        <input type="hidden" name="redirect_uri" value="{{route('home.wechat.callback')}}">
        @csrf
        
    </div>
@endsection

@section('scripts')
<script src="http://res.wx.qq.com/connect/zh_CN/htmledition/js/wxLogin.js"></script>
<script>
    window.onload = function(){
        const redirect_uri = document.querySelector("input[name=redirect_uri]").getAttribute("value");
        const encodedUrl = encodeURIComponent(redirect_uri);
        const _token = document.querySelector("input[name=_token]").getAttribute("value");
        const appid = document.querySelector("input[name=appid]").getAttribute("value");
        const obj = new WxLogin({
            self_redirect:true,
            id:"login_container", 
            appid: appid, 
            scope: "snsapi_login", 
            redirect_uri: encodedUrl,
            state: _token,
        });
    }
</script>
@endsection
