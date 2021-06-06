<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserLike;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['like','image_url'];

    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function userlike($user_id){
        return $this->hasOne(UserLike::class,'post_id')->where('post_type',UserLike::Article)->where('user_id',$user_id);
    }

    public function usersLike(){
        return $this->hasMany(UserLike::class,'post_id')->where('post_type',UserLike::Article);
    }

    public function getUsersLikeAttribute(){
        return UserLike::where('post_type',UserLike::ARTICLE)->where('post_id',$this->id)->latest();
    }

    //登录用户是否点赞
    public function getLikeAttribute(){
        $auth_id = auth()->id();
        // $auth_id = 1;
        $result = UserLike::where('post_type',UserLike::ARTICLE)->where('post_id',$this->id)->where('user_id',$auth_id)->first();
        if($result){
            return true;
        }
        return false;
    }

    public function setImageAttribute($value)
    {
        //check if the image exist in storage folder after upload
    }

    public function getImageUrlAttribute(){

        $image = $this->attributes['image']??null;
        if(strpos($image,'http://') or strpos($image,'https://')){
            return $image;
        }

        if(Storage::exists($image)){
            return Storage::url($image);
        }

    }

    //有了对应setter,可以删掉此getter. 暂时保留测试之用,
    public function getDescriptionAttribute(){
        if(!$this->attributes['description']){
            return mb_substr(strip_tags($this->attributes['content']),0,50).'...';
        }

        return $this->attributes['description'];
    }

    public function setDescriptionAttribute($value){
        if(empty($value)){
            $this->attributes['description'] = mb_substr(strip_tags(request()->content),0,50).'...';
        }else{
            $this->attributes['description'] = $value;
        }

    }


}
