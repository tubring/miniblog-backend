<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;

class SocialAccount extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'social_account';

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    /**
     * 自动创建新用户
     */
    public function autoCreate($data){

        $platform = $data['platform']??'user';
        $user = User::create([
            'username'=>$platform.'-'.Str::random(12),
        ]);
        
        $data = array_merge($data,['user_id'=>$user->id]);
        $account = SocialAccount::create($data);

        return $account;

    }


}
