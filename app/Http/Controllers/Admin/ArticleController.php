<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleStoreRequest;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index(Request $request){
        $articles = Article::with('category')->latest()->paginate(10);

        return response()->json($articles,200);
    }

    public function store(ArticleStoreRequest $request){

        $article = Article::create($request->only(['title','author','category_id','description','content','image','active','sort_order','recommended']));

        return response()->json($article,200);
    }

    public function show(Article $article)
    {
        return response()->json($article,200);
    }

    public function update(Request $request, Article $article)
    {
        $result = $article->update($request->only(['title','author','category_id','description','content','image','active','sort_order','recommended']));

        return response()->json($article,201);

    }

    public function destroy(Article $article)
    {
        $article->delete();
        return response()->json(null,204);
    }

    public function active(Article $article)
    {
        $article->active = !$article->active;
        $article->save();

        return response()->json(null,204);
    }

    public function comments($id)
    {
        $comments = Article::where('id', $id)->with('comments')->paginate(10);
        return response()->json($comments,200);
    }

    public function relative(){
        
    }

    
 }
