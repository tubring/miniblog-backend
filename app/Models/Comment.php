<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserLike;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['children'];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];

    public function article(){
        return $this->belongsTo('App\Models\Article');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    //指定用户是否点赞
    public function like($user_id){
        return $this->hasOne(UserLike::class,'post_id')->where('post_type',UserLike::COMMENT)->where('user_id',$user_id);
    }


    public function getUsersLikeAttribute(){
        return UserLike::where('post_type',UserLike::COMMENT)->where('post_id',$this->id)->latest();
    }

    protected function toTree($nodes=[],$parentId=0){

        $result = [];

        if (empty($nodes)) {
           return $nodes;
        }

        foreach($nodes as $node) {
            if($node['parent_id'] == $parentId) {
                $children = $this->tree($nodes, $node['id']);

                if($children) {
                    $node['children'] = $children;
                }

                $result[] = $node;
            }
        }

        return $result;
    }

    public function parent(){
        return $this->belongsTo(Comment::class,'parent_id');
    }

    public function children(){
        return $this->hasMany(Comment::class,'parent_id');

    }

    public function getChildrenAttribute(){
        return $this->children()->get();
    }


}
