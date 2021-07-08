<?php

namespace App\Http\Controllers\API\Chat;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChatMediaStore;
use App\Http\Resources\ModelResource;
use App\Models\ChatMedia;
use App\Q8\FileManager;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;

class ChatMediaController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param ChatMediaStore $request
     * @return ModelResource
     * @throws FileNotFoundException
     */
    public function store(ChatMediaStore $request)
    {
        //
        $userId = auth()->id();
        $chatMedia = new ChatMedia;
        $chatMedia->type = $this->getMediaType($request->media_file);
        $chatMedia->user_id = $userId;
        $chatMedia->chat_room_id = $request->chat_room_id;
        $chatMedia->media_file = FileManager::storeFile('chat/'.$userId, $request->media_file);
        $chatMedia->save();
        return new ModelResource($chatMedia);
    }

    /**
     * @param File $file
     * @return string
     */
    private function getMediaType($file)
    {
        $mime = substr(strrchr($file->getMimeType(), "/"), 1);
        foreach (config('media-extensions') as $key => $values)
        {
            if (in_array($mime, $values))
                return $key;
        }
        return "other";
    }

}
