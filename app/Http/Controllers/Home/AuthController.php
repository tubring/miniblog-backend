<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(){

        $appid = config('services.wechat.appid');

        return view('home.auth.wechat')->with('appid',$appid);
    }


    public function login(){
    }

    public function logout(){

        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');

    }

}
