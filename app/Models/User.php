<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'nickname',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['is_admin'];

    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }

    public function favoriteArticles(){
        return $this->hasMany('App\Models\UserLike')->where('post_type',UserLike::ARTICLE);
    }

    public function admin(){
        return $this->hasOne('App\Models\UserAdmin');
    }

    public function getIsAdminAttribute(){
        if($this->admin()->first()){
            return true;
        }
        return false;
    }
    
    //
    public function history(){
        return $this->belongsToMany('App\Models\Article','user_browsing_history')->withTimestamps();
        // return $this->belongsToMany('App\Models\Article')->using('App\Model\UserBrowsingHistory');
    }
    
    public function socialAccount()
    {
        return $this->hasOne('App\Models\SocialAccount');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

}
