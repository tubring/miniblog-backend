<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CommentStoreRequest;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Setting;

class CommentController extends Controller
{

    public function store(Article $article, CommentStoreRequest $request)
    {
        $commmentable = Setting::where('key', 'app.commentable')->first();

        if( !$commentable || !$article->commentable){
            return response()->json(null,404);
        }

        $comment = $article->comments()->create($request->only(['parent_id','content','anonymous'])+['user_id'=>auth()->id(),'user_nickname'=>auth()->user()->nickname]);

        return response()->json($comment,200);

    }

    public function update(Request $request,Comment $comment)
    {   
        $comment->update($request->only(['article_id','parent_id','content','anonymous'])+['user_id'=>auth()->id(),'user_nickname'=>auth()->user()->nickname]);
        return response()->json($comment,201);

    }

    public function destroy(Request $request,Comment $comment)
    {   
        $comment->delete();
        return response()->json(null,204);

    }

}
