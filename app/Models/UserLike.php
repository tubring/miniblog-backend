<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLike extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    const ARTICLE = 1;
    const COMMENT = 2;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function post()
    {
        if($this->post_type==Self::ARTICLE){
            return $this->hasOne('App\Models\Article','post_id');
        }elseif($this->post_type==Self::COMMENT){
            return $this->hasOne('App\Models\Comment','post_id');
        }
    }

    public function favorable(){
        return $this->morphTo();
    }

}
