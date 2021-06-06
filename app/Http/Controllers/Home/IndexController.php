<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Casts\Date;

class IndexController extends Controller
{
    public function index(Request $request){
        $limit = 10;
        $query = Article::query();
        if($request->keyword){
            $query->where('title','like','%'.$request->keyword.'%');
        }
        if($request->category_id){
            $query->where('category_id',$request->category_id);
        }

        $articles = $query->with('category',function($query){
            $query->select('id','name');
        })->withCasts(['created_at'=>Date::class])
        ->where('active',1)->orderBy('recommended')->latest()->take($limit)->get();

        return view('home.index')->with('articles',$articles);
    }
}
