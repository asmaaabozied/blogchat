<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\User;

class SearchController extends Controller
{
    public function search(string $key)
    {
        $users = User::where('name', 'like', '%' . $key . '%')->paginate(10);
        $media = Media::where('custom_properties->description', 'like', '%' . $key. '%')->paginate(10);
        $groups = auth()->user()->groups()->where('name', 'like', '%' .$key . '%')->paginate(10);
        return [
            'users' => $users,
            'media' => $media,
            'groups' => $groups,
        ];
    }
}
