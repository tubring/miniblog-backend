<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAdmin;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::has('admin')->with('socialAccount')->get();
        return response()->json($admins,200);
    }
}
