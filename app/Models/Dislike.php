<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dislike extends Model
{
    protected $table = 'dislikes';
    protected $guarded = [];

    public function likable()
    {
        return $this->morphTo('dislikable');
    }
}
