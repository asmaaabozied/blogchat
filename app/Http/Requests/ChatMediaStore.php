<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChatMediaStore extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $extensions = config('media-extensions');
        return [
            'media_file' => 'required|mimes:'
                .implode(",", $extensions['image']) .','
                .implode(",", $extensions['video']) .','
                .implode(",", $extensions['audio']),
            'chat_room_id' => 'required|string|max:150' ,
        ];
    }
}
