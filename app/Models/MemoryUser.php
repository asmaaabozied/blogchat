<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemoryUser extends Model
{
    protected $table = 'memory_user';
    protected $fillable = ['user_id', 'post_id'];
}
