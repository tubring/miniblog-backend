<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiBaseController as Controller;
use Illuminate\Http\Request;
use App\Repositories\ArticleRepository;
use App\Models\Article;
use App\Models\UserLike;
use App\Models\Setting;

class ArticleController extends Controller
{

    public function index(Request $request)
    {
        $query = Article::query();
        if($request->keyword){
            $query->where('title','like','%'.$request->keyword.'%');
        }
        if($request->category_id){
            $query->where('category_id',$request->category_id);
        }

        $articles = $query->with('category',function($query){
            $query->select('id','name');
        })->where('active',1)->orderBy('recommended')->latest()->paginate(10);
        return response()->json($articles,200);
    }

    public function show($article_id)
    {
        $article = Article::with(['comments'=>function($query){
                                    $query->where('approved',true)->where('parent_id',null)->limit(10);
                                }],)->where('id',$article_id)->first();

        if($article->active!=1){
            return response()->json(null,404);
        }
        $article->views++;
        $article->save();

        return response()->json($article,200);
        
    }

    /**
     * 
     */
    public function like(Article $article, Request $request)
    {
        // $uid = auth()->id();
        // if(!$uid){
        //     return response()->json(['message'=>'用户未登录'],404);
        // }
        $uid = 1;

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
            if($article->like>0){
                $article->likes--;
            }
            
        }

        $article->save();
        
        return response()->json([],200);
    }

    public function comments(Article $article){
        $comments = Article::where('id', $article->id)->with('comments')->paginate(10);
        return response()->json($comments,200);
    }

    public function commentStore(Article $article,Request $request){

        $commmentable = Setting::where('key', 'app.commentable')->first();

        if( !$commentable || !$article->commentable){
            return response()->json(null,404);
        }

        $comment = $article->comments()->create($request->only(['parent_id','content','anonymous'])+['user_id'=>auth()->id(),'user_nickname'=>auth()->user()->nickname]);

        return response()->json($comment,201);
    }

    public function search(Request $request){
        $keywords = trim($request->keywords);
        if($keywords){
            $articles = Article::where('title','like','%'.$keywords.'%')->latest()->paginate(10);
            return response()->json($articles,200);
        }

    }


}
