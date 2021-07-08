<?php

namespace App\Models;

use Carbon\Carbon;
use HighIdeas\UsersOnline\Traits\UsersOnlineTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasFactory;
    use Notifiable;
    use InteractsWithMedia;
    use HasApiTokens;
    use CausesActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'last_activity',
        'is_active',
        'country_id',
        'bio',
        'whatsapp',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'media'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */

    protected $appends = ['photo', 'is_followed_by_me', 'country_name', 'is_online'];

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_user', 'user_id', 'group_id')->withPivot('is_admin')->using(GroupUser::class)->withTimestamps();
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'to_id', 'id');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'from_id', 'id');
    }

    public function adminMessages()
    {
        return $this->hasMany(Message::class, 'to_id', 'id')->where('from_id', null);
    }

    public function getPhotoAttribute($value)
    {
        return $this->getFirstMediaUrl('profile');
    }

       public function registerMediaCollections(): void
    {
        $this->addMediaCollection('profile')->singleFile();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follower_user', 'user_id', 'follower_id')->withPivot('is_accepted')->using(FollowerUser::class)->withTimestamps();
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follower_user', 'follower_id', 'user_id')->withPivot('is_accepted')->using(FollowerUser::class)->withTimestamps();
    }

    public function savedPost()
    {
        return $this->hasManyThrough(Post::class, SavedUser::class, 'user_id', 'id', 'id', 'post_id');
    }

    public function memoryPost()
    {
        return $this->hasManyThrough(Post::class, MemoryUser::class, 'user_id', 'id', 'id', 'post_id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class, 'user_id', 'id');
    }

    public function likedPost()
    {
        return $this->hasManyThrough(Post::class, Like::class, 'user_id', 'collection_name', 'id', 'likable_id');
    }

    public function getIsFollowedByMeAttribute()
    {
        return auth()->user()->following ? auth()->user()->following->contains($this->id) : false;
    }


    public function getCountryNameAttribute()
    {
        return $this['country_id'] ? $this->country->name : '';
    }

    public function commentActivities()
    {
        return Activity::where('log_name', 'comment')->where('subject_type', Media::class)->whereIn('subject_id', $this->media()->pluck('id'));
    }

    public function likeActivities()
    {
        return Activity::where('log_name', 'like')->where('subject_type', Post::class)->WhereIn('subject_id', auth()->user()->posts()->pluck('id'))
            ->orWhere('subject_type', Comment::class)->WhereIn('subject_id', auth()->user()->comments()->pluck('id'))
            ->orWhere('subject_type', Reply::class)->WhereIn('subject_id', auth()->user()->replies()->pluck('id'));
    }

    public function followActivity()
    {
        return Activity::where('log_name', 'follow')->where('subject_type', User::class)->where('subject_id', auth()->id());
    }

    public function dislikedPost()
    {
        return $this->hasManyThrough(Post::class, Dislike::class, 'user_id', 'collection_name', 'id', 'dislikable_id');
    }

    public function getIsOnlineAttribute()
    {
        return $this->last_activity ? Carbon::create($this->last_activity)->diffInMinutes(now(config('app.timezone'))) < 1 : false;
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

}
