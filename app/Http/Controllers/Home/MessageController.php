<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Repositories\FeedbackRepository;
use App\Http\Requests\FeedbackRequest;

class MessageController extends Controller
{
    public function index(){
        return view('home.message.index');
    }

    public function store(FeedbackRequest $request, FeedbackRepository $repository){
        
        $feedback = $repository->store($request->only(['name','content','contact'])+['user_id'=>auth()->id()]);

        return redirect()->route('home.message.index')->with('success',"发送成功");

    }
}
