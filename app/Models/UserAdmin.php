<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAdmin extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'user_admin';

    public function user(){
        return $this->hasOne('App\Models\User');
    }
}
