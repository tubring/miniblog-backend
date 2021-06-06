<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserBrowsingHistory extends Pivot
{
    use HasFactory;
    
    protected $guarded = [];
    protected $table = 'user_browsing_history';


}
