<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Group extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['name', 'description'];
    protected $with = ['users'];
    protected $appends = ['admins', 'is_group_admin', 'img_url'];
    protected $hidden = ['media'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('groups')->singleFile();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'group_user', 'group_id', 'user_id')->withPivot('is_admin')->using(GroupUser::class)->withTimestamps();
    }

    public function getAdminsAttribute()
    {
        return $this->users()->wherePivot('is_admin', true)->get();
    }

    public function getIsGroupAdminAttribute()
    {
        return $this->getAdminsAttribute()->contains(auth()->user());
    }

    public function getImgUrlAttribute()
    {
        return $this->hasMedia('groups') ? $this->getFirstMediaUrl('groups') : '';

    }
}
