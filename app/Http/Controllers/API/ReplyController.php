<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyStore;
use App\Http\Requests\ReplyUpdate;
use App\Http\Resources\ReplyCollection;
use App\Models\Reply;
use App\Q8\FileManager;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ReplyCollection
     */
    public function index()
    {
        return new ReplyCollection(auth()->user()->replies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return ReplyCollection
     */
    public function store(ReplyStore $request)
    {
        $userId = auth()->id();
        $request['user_id'] = $userId;
        $reply = Reply::create($request->all());
        if ($request->hasFile('media'))
            foreach ($request['media'] as $item) {
                $reply->addMedia($item)
                    ->usingFileName(
                        FileManager::generateFileNameFromFile($item)
                    )
                    ->toMediaCollection('replies');
            }
        return new ReplyCollection(collect($reply));
    }

    /**
     * Display the specified resource.
     *
     * @param Reply $reply
     * @return ReplyCollection
     */
    public function show(Reply $reply)
    {
        return new ReplyCollection(collect($reply->load('replies')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Reply $reply
     * @return ReplyCollection
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function update(ReplyUpdate $request, Reply $reply)
    {
        $userId = auth()->id();
        $request['user_id'] = $userId;
        $reply->update($request->all());
        if ($request->hasFile('media'))
            foreach ($request['media'] as $item) {
                $reply->addMedia($item)
                    ->usingFileName(
                        FileManager::generateFileNameFromFile($item)
                    )
                    ->toMediaCollection('replies');
            }
        return new ReplyCollection(collect($reply));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Reply $reply
     * @return Response
     * @throws Exception
     */
    public function destroy(Reply $reply)
    {
        $reply->delete();
        return \response(null, Response::HTTP_NO_CONTENT);
    }

    public function getReplies(Request $request, Reply $reply)
    {
        return new ReplyCollection($reply->replies);
    }
}
