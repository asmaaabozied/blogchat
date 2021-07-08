<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Models\Category;

class CategoryController extends Controller
{
    public function allCats()
    {
        $cats = Category::all();
        $catss = CategoryCollection::collection($cats);
        return ($catss);
    }

    public function paidCats()
    {
        $cats = Category::all()->where('is_paid', true);
        $catss = CategoryCollection::collection($cats);
        return ($catss);
    }

    public function unpaidCats()
    {
        $cats = Category::all()->where('is_paid', false);
        $catss = CategoryCollection::collection($cats);
        return ($catss);
    }

    public function show($id)
    {
        $category = Category::find($id);
        return new CategoryCollection($category);
    }
}
