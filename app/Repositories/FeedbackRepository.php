<?php 

namespace App\Repositories;

use App\Models\Feedback;

class FeedbackRepository extends Repository{

    public function store($data){
        $feedback = Feedback::create($data);
        return $feedback;
    }

}