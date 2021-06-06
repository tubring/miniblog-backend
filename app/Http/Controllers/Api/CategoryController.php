<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;

class CategoryController extends Controller
{
    public function index(){
        $category = Category::all();
        return response()->json($category,200);
    }

    public function articles($category_id){

        $articles = Article::where('category_id',$category_id)->latest()->paginate(10);
        return response()->json($articles,200);

    }
}
