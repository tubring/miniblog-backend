<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\FeedbackRepository;
use App\Http\Requests\FeedbackRequest;

class FeedbackController extends Controller
{

    public function store(FeedbackRequest $request, FeedbackRepository $repository){
        $feedback = $repository->store($request->only(['name','content','contact'])+['user_id'=>auth()->id()]);
        return response()->json($feedback,201);
    }
}
