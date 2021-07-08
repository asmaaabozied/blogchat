<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\FamilyBlog;

class FamilyBlogController extends Controller
{
    public function getBlogs()
    {
        return [
            'data' => FamilyBlog::with('media')->get(),
        ];
    }
}
