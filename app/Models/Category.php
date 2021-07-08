<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';

    protected $fillable = ['image','title', 'is_paid', 'order', 'place'];
    protected $hidden = ['popular_media'];

    public function posts()
    {
        return $this->hasMany(Post::class, 'cat_id', 'id')->orderBy('id', 'desc');
    }

    public function popularPosts()
    {
        return $this->hasMany(Post::class, 'cat_id', 'id')->orderBy('views')->take(10);
    }

    public function advertisements()
    {
        return $this->hasMany(Ad::class, 'category_id', 'id');
    }

}
