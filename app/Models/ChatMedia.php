<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMedia extends Model
{
    use HasFactory;

    protected $fillable
        = [
            'message',
            'type',
            'user_id',
            'chat_room_id',
        ];

    protected $appends = ['mediaUrl'];

    public function getMediaUrlAttribute()
    {
        return $this->media_file ? config('app.url') . '/' . $this->media_file : '';
    }

}
