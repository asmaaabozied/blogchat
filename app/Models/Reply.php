<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Reply extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $guarded = ['id', 'media'];

    protected $with = ['user'];
    protected $appends = ['replies_count', 'likes_count'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function repliable()
    {
        return $this->morphTo('repliable');
    }

    public function replies()
    {
        return $this->morphMany(Reply::class, 'repliable');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likable', '', '', 'id');
    }

    public function getRepliesCountAttribute()
    {
        return $this->replies()->count();
    }

    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }

    public function dislikes()
    {
        return $this->morphMany(Dislike::class, 'dislikable', '', '', 'id');
    }

    public function familyBlog()
    {
        return $this->hasOne(FamilyBlog::class, 'id', 'family_blog_id');
    }


}
