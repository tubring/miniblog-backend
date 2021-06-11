<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Comment;
use App\Models\UserLike;
use App\Casts\Date;
use App\Repositories\ArticleRepository;

class ArticleController extends Controller
{
    public function __construct(ArticleRepository $repository){
        parent::__construct();
        $this->ArticleRepository = $repository;
    }
    

    public function index(){

        $articles = $this->ArticleRepository->list();
        
        // dd($articles);
        return view('home.blog.index')->with('articles',$articles);
    }

    public function show($id){

        $article = Article::withCasts(['created_at'=>Date::class])->find($id);
        $article->views++;
        $article->save();

        if($article->active!=1){
            abort(404);
        }

        //用户是否点赞
        $like = false;
        if($uid = auth()->id()){
        // if($uid = 1){ //testcode
            $user_like = UserLike::where('post_type',UserLike::ARTICLE)->where('post_id',$id)->where('user_id',$uid)->first();
            if($user_like){
                $like = true;
            }
        }
        // $like = true;//test code

        return view('home.blog.show')->with('article',$article)->with('like',$like);
    }

    //点赞
    public function like(Article $article, Request $request){

        $this->authorize('like',$article);

        $result = $this->ArticleRepository->setLike($article,$request);

        return response()->json($result,200);

    }

    public function comments(Article $article){
        
        $comments = $this->ArticleRepository->getComments($article->id);
       
        return view('home.blog.comment')->with('comments',$comments)->with('article',$article);

    }

}
