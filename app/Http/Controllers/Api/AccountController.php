<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiBaseController as Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
use App\Models\UserBrowsingHistory;

class AccountController extends Controller
{

    public function user_info(){

        $user = auth()->user();

        return response()->json($user,200);
    }

    public function comments(){

        $comments = Comment::with(['article'=>function($query){
            $query->select(['id','title'])->where('active',1);
        }])->where('user_id',auth()->id())->paginate(10);

        return response()->json($comments,200);
    }

    public function history(){

        $history_list = UserBrowsingHistory::with(['article'=>function($query){
            $query->select(['id','title'])->where('active',1);
        }])->where('user_id',auth()->id())->paginate(10);

        return response()->json($history_list,200);

    }

    public function favorite(){

        $favorite_list = UserLike::with(['article'=>function($query){
            $query->select(['id','title'])->where('active',1);
        }])->where('user_id',auth()->id())->paginate(10);
        
        return response()->json($favorite_list,200);

    }

}
