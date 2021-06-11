<?php 

namespace App\Repositories;

use App\Models\Article;
use App\Models\UserLike;
use App\Models\Comment;
use App\Models\Setting;

class ArticleRepository extends Repository{

    public function list($per_page=2){

        $request = request();
        $query = Article::query();
        if($request->keyword){
            $query->where('title','like','%'.$request->keyword.'%');
        }
        if($request->category_id){
            $query->where('category_id',$request->category_id);
        }

        $articles = $query->with('category',function($query){
            $query->select('id','name');
        })->where('active',1)->orderBy('recommended')->latest()->paginate($per_page);
        return $articles;
    }

    public function findOne(Article $article){

    }


    //点赞
    public function SetLike(Article $article, $request)
    {
        $uid = auth()->id();
        // if(!$uid){
        //     return response()->json(['message'=>'用户未登录'],404);
        // }
        // $uid = 1;

        $like = UserLike::where('post_type',UserLike::ARTICLE)->where('post_id',$article->id)->where('user_id',$uid)->first();

        if(!$like && $request->like == true ){
            $like = UserLike::create([
                'post_type'=>UserLike::ARTICLE,
                'post_id'=>$article->id,
                'user_id'=>$uid,
            ]);
            $article->likes++;

        }elseif($like && $request->like == false ){

            $like->delete();
            if($article->likes>0){
                $article->likes--;
            }
            
        }

        $article->save();
        
        return [
            'like' =>$request->like,
            'total_likes' => $article->likes,
        ];
    }

    public function getComments($article_id){
        
        $comments = Comment::where('article_id',$article_id)->where(function($query){
            $query->where('approved',1)->orWhere('user_id',auth()->id());

        })->with('user')->latest()->paginate(10);

        return $comments;
    }

}