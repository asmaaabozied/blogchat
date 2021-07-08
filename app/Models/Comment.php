<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Comment extends Model  implements HasMedia
{

    use HasFactory, InteractsWithMedia;

    protected $fillable = ['post_id', 'user_id', 'content', 'family_blog_id'];
    protected $with = ['user', 'familyBlog'];
    protected $appends = ['replies_count', 'likes_count','dislikes_count', 'is_liked_by_me', 'is_disliked_by_me'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function mediaCollection()
    {
        return $this->hasMany(Media::class, 'collection_name', 'collection_name');
    }

    public function replies()
    {
        return $this->morphMany(Reply::class, 'repliable');
    }

    public function getRepliesCountAttribute()
    {
        return $this->replies()->count();
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likable', '', '', 'id');
    }

    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }

    public function dislikes()
    {
        return $this->morphMany(Dislike::class, 'dislikable', '', '', 'id');
    }




    public function getDislikesCountAttribute()
    {
        return $this->dislikes()->count();
    }



    public function familyBlog()
    {
        return $this->hasOne(FamilyBlog::class, 'id', 'family_blog_id');
    }

    public function getIsLikedByMeAttribute()
    {
        if (auth()->user())
            return auth()->user()->likedMedia ? auth()->user()->likedMedia->contains($this->id) : false;
        return false;
    }

    public function getIsDislikedByMeAttribute()
    {
        if (auth()->user())
            return auth()->user()->dislikedMedia ? auth()->user()->dislikedMedia->contains($this->id) : false;
        return false;
    }
}
