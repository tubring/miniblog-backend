<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        if(auth()->user()){

            $data = [
                'message'=>'您已经登录过'
            ];

            return response()->json($data,200);
        }
        $this->validateRequest($request);

        //
        $user = User::where($this->username(), $request->{$this->username()})->first();

        if (! $user || ! Hash::check($request->password, $user->password) || ! $user->is_admin) {
            throw ValidationException::withMessages([
                'message' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('admin_token')->accessToken;

        $data = [
            'user' => $user,
            'token' => $token,
        ];

        return \response()->json($data,200);

    }

    public function logout(Request $request){
        if($request->user()){
            $request->user()->token()->delete();
        }
        return response(null, 204);
    }

    protected function validateRequest(Request $request){
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    protected function username(){
        return "username";
    }
}
