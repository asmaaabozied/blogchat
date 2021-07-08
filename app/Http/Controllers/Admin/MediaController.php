<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.media.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.media.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'media' => 'required',
        ]);
        $user = User::find($request['user_id']);
        $uuid = $this->unique_code(5);
        foreach ((array)$request['media'] as $item) {
            $media = $user->addMedia($item)
                ->sanitizingFileName(function ($fileName) {
                    return \Str::slug($fileName);
                })->usingFileName(Carbon::now()->timestamp . '. ' . $item->getClientOriginalExtension())
                ->withCustomProperties(['description' => $request['description']])
                ->toMediaCollection($user['id'] . '-videos.' . $uuid);
            $media->update(['cat_id' => $request['cat_id']]);
        }
        $this->actionSuccess();
        return redirect()->route('media.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Media $media
     * @return Response
     */
    public function show(Media $media)
    {
        return view('admin.media.show', compact('media'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Media $media
     * @return Response
     */
    public function edit(Media $media)
    {
        return view('admin.media.edit', compact('media'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Media $media
     * @return Response
     * @throws Exception
     */
    public function update(Request $request, Media $media)
    {
//        $request->validate([
//            'user_id' => 'required|exists:users,id',
//            'name' => 'required',
//        ]);
//        $user = User::find($request['user_id']);
//        if ($request->hasFile('media')) {
//            $media->delete();
//            $user->addMediaFromRequest('media')
//                ->sanitizingFileName(function ($fileName) {
//                    return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
//                })
//                ->usingFileName($request['name'] . '.' . $request->file('media')->getClientOriginalExtension())
//                ->toMediaCollection('videos');
//        }
//        $media->update([
//            'model_id' => $request['user_id'],
//            'file_name' => $request['name'],
//        ]);
//        $this->actionSuccess();
//        return redirect()->route('media.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Media $media
     * @return Response
     * @throws Exception
     */
    public function destroy(Media $media)
    {
        $media->delete();
        $this->actionSuccess();
        return back();
    }
}
