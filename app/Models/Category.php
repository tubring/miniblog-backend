<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'category';
    protected $appends = ['icon_url'];

    public function posts(){
        return $this->hasMany('App\Models\Article');
    }

    public function articles(){
        return $this->posts();
    }

    public function getIconUrlAttribute(){
        
        $icon = $this->attributes['icon']??null;

        if(!$icon){
            return ;
        }

        if(strpos($icon,'http://') or strpos($icon,'https://')){
            return $icon;
        }

        if(Storage::exists($icon)){
            return Storage::url($icon);
        }

    }

}
