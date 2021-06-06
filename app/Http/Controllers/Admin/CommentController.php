<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index(Request $request){
        $query = Comment::query();
        if($request->approved===0){
            $query = $query->where('approved',0);
        }
       $comments = $query->latest()->paginate(10);
       return response()->json($comments,200);
    }

    public function show(Comment $comment)
    {
        return response()->json($comment,200);
    }

    public function approved(Comment $comment)
    {
        $comment->approved = !$comment->approved;
        $comment->save();

        return response()->json(null,204);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->json(null,204);
    }
}
