<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class FamilyBlog extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'family';
    protected $fillable= ['name'];


    public function comment()
    {
        return $this->belongsTo(Comment::class, 'family_blog_id', 'id');
    }
}
