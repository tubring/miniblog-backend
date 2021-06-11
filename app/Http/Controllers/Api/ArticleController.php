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
    public function __construct(ArticleRepository $repository){
        parent::__construct();
        $this->ArticleRepository = $repository;
    }

    public function index(Request $request)
    {
        $articles = $this->ArticleRepository->list(10);
        return response()->json($articles,200);
    }

    public function show($article_id)
    {
        $article = Article::with(['comments'=>function($query){
                                    $query->where('approved',true)->where('parent_id',null)->limit(10);
                                }],)->where('id',$article_id)->first();

        if($article->active!=1){
            abort(404);
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
        
        $result = $this->ArticleRepository->setLike($article,$request);
        
        return response()->json($result,200);
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
