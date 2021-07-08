<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Country extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['name', 'code', 'rate'];
    protected $appends = ['flag_url'];
    protected $hidden = ['media'];

    public function users()
    {
        return $this->hasMany(User::class, 'country_id', 'id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('flags')->singleFile();
    }

    public function getFlagUrlAttribute()
    {
        return $this->hasMedia('flags') ? $this->getFirstMediaUrl('flags') : '';
    }
}
