<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    protected $guarded = [];
    protected $fillable = ['message', 'from_id', 'to_id', 'group_id', 'type'];

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'from_id', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'to_id', 'id');
    }
}
