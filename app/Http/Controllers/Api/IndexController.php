<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Banner;

class IndexController extends Controller
{
    public function index()
    {
        $articles = Article::select(['id','title','description','created_at','content'])
                    ->with(['category'=>function($query){
                            $query->select(['id','name']);
                        }])
                    ->where('active',1)->orderBy('recommended')->orderBy('sort_order')->latest()->limit(10)->get();

        $banners = Banner::where('active',1)->orderBy('sort_order')->get();

        return response()->json([
            'articles' => $articles,
            'banners' => $banners,
        ],200);
    }

    public function info()
    {
        $settings = Setting::getConfig();
        return response()->json($settings,200);
    }
}
