<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $users = User::with('socialAccount')->latest()->paginate(10);
        return response()->json($users,200);
    }

    public function show($id)
    {
        $user = User::with('socialAccount')->where('id',$id)->first();
        return response()->json($user,200);
    }

    public function destroy(User $user){
        $user->delete();
        return response()->json(null,204);
    }

    //管理员列表
    public function admins(){
        $admins = User::has('admin')->with('socialAccount')->get();
        return response()->json($admins,200);
    }

    //设置为管理员
    public function createAdmin(User $user){
        if(!$user->is_admin){
            $user->admin()->create(['user_id'=>$user->id]);
        }

        return response()->json(null,204);
    }

    //删除管理员
    public function deleteAdmin(User $user){
        if(!$user->is_admin){
            $user->admin()->delete();
        }
        return response()->json(null,204);

    }
    
}
