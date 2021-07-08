<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'content',
        'cat_id',
        'user_id'
    ];

    protected $appends = [
        'comments_count',
        'likes_count',
        'is_liked_by_me',
        'is_saved_by_me',
        'is_memorized_by_me',
        'is_disliked_by_me',
        'dislikes_count',
    ];

    protected $with = [
      'user'
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('groups')->singleFile();
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getCommentsCountAttribute()
    {
        return $this->comments()->count();
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likable');
    }

    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }

    public function getIsLikedByMeAttribute()
    {
        if (auth()->user())
            return auth()->user()->likedMedia ? auth()->user()->likedMedia->contains($this->id) : false;
        return false;
    }

    public function getIsSavedByMeAttribute()
    {
        if (auth()->user())
            return auth()->user()->savedMedia ? auth()->user()->savedMedia->contains($this->id) : false;
        return false;
    }

    public function getIsMemorizedByMeAttribute()
    {
        if (auth()->user())
            return auth()->user()->memoryMedia ? auth()->user()->memoryMedia->contains($this->id) : false;
        return false;
    }

    public function dislikes()
    {
        return $this->morphMany(Dislike::class, 'dislikable');
    }
    public function getDislikesCountAttribute()
    {
        return $this->dislikes()->count();
    }


    public function getIsDislikedByMeAttribute()
    {
        if (auth()->user())
            return auth()->user()->dislikedMedia ? auth()->user()->dislikedMedia->contains($this->id) : false;
        return false;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
