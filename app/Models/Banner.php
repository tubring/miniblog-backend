<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['image_url'];

    public function getImageUrlAttribute(){

        $image = $this->attributes['image']??null;

        if(!$image){
            return ;
        }

        if(strpos($image,'http://') or strpos($image,'https://')){
            return $image;
        }

        if(Storage::exists($image)){
            return Storage::url($image);
        }

    }

    
}
