<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Ad extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'ads';
    protected $fillable = ['name', 'is_active', 'category_id', 'collection_name'];

    protected $with = ['media'];

     public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }


}
