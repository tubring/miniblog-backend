<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentStoreRequest;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Setting;

class CommentController extends Controller
{
    public function store(Article $article, CommentStoreRequest $request)
    {
        if(!auth()->check()){
            return back()->with('error','用户未登录!');
        }

        $commentable = Setting::where('key', 'app.commentable')->first();

        if( !$commentable || !$article->commentable){
            return back()->with('error','不可评论!');
        }

        // $comment = $article->comments()->create($request->only(['parent_id','content','anonymous'])+['user_id'=>auth()->id(),'user_nickname'=>auth()->user()->nickname]);
        $comment = $article->comments()->create($request->only(['parent_id','content','anonymous'])+['user_id'=>1,'user_nickname'=>'John Doe']);//test

        return back()->with('success','评论成功!');

    }

    public function update(){

    }

    public function destroy(Article $article, Comment $comment)
    {   
        $this->authorize('delete',$comment);
        //权限控制
        $comment->delete();
        return response()->json(null,204);

    }

}
