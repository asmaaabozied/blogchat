<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentUpdate extends FormRequest
{

    public function authorize()
    {
        return true;
    }



    public function rules()
    {
        $extensions = config('media-extensions');
        return [
            'media' => 'required_without_all:content,family_blog_id|array',
            'media.*' => 'mimes:'
                . implode(",", $extensions['image']) . ','
                . implode(",", $extensions['video']) . ','
                . implode(",", $extensions['audio']),
            'content' => 'required_without_all:media,family_blog_id|string|max:10000',
            'family_blog_id' => 'required_without_all:media,content|exists:family,id'
        ];
    }
}
