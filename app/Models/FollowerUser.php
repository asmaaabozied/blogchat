<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FollowerUser extends Pivot
{
    protected $table = 'follower_user';
    protected $fillable = ['user_id', 'follower_id'];
}
