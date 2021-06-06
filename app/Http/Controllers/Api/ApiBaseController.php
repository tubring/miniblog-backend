<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiBaseController extends Controller
{
    public function __construct(){
        // if(!auth()->check()){
        //     $res = [
        //         'message'=>'Unauthenticated'
        //     ];
        //     return response()->json($res,404);
        // }
    }

}
