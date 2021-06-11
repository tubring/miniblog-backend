<?php 

namespace App\Repositories;

use App\Models\Article;
use App\Models\UserLike;
use App\Models\Comment;
use App\Models\Setting;

class CommentRepository extends Repository{


    //点赞
    public function SetLike(Comment $comment, $request)
    {
        // $uid = auth()->id();
        // if(!$uid){
        //     return response()->json(['message'=>'用户未登录'],404);
        // }
        $uid = 1;

        $like = UserLike::where('post_type',UserLike::COMMENT)->where('post_id',$comment->id)->where('user_id',$uid)->first();

        if(!$like && $request->like == true ){
            $like = UserLike::create([
                'post_type'=>UserLike::COMMENT,
                'post_id'=>$comment->id,
                'user_id'=>$uid,
            ]);
            $comment->likes++;

        }elseif($like && $request->like == false ){

            $like->delete();
            if($comment->like>0){
                $comment->likes--;
            }
            
        }

        $comment->save();
        
        return [
            'like' =>$request->like,
            'total_likes' => $comment->likes,
        ];
    }

}