<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Media;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $items = \App\Models\Comment::all();
        return view('admin.comments.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.comments.create');
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
            'collection_name' => 'required',
            'content' => 'required',
        ]);
        $comment = Comment::create($request->all());
        if ($request->hasFile('media'))
            $media = $comment->addMediaFromRequest('media')
                ->usingFileName(Carbon::now()->timestamp . '.' . $request['media']->getClientOriginalExtension())
                ->toMediaCollection($comment['id'] . '-comments');
        activity('comment')
            ->causedBy(User::find($request['user_id']))
            ->performedOn(Media::where('collection_name', $request['collection_name'])->first())
            ->log(User::find($request['user_id'])->name . ' Commented on your post');
        $this->actionSuccess();
        return redirect()->route('comment.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Comment $comment
     * @return Response
     */
    public function show(Comment $comment)
    {
        return view('admin.comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Comment $comment
     * @return Response
     */
    public function edit(Comment $comment)
    {
        return view('admin.comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Comment $comment
     * @return Response
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'collection_name' => 'required',
            'content' => 'required',
        ]);
        $comment->update($request->all());
        if ($request->hasFile('media'))
            $media = $comment->addMediaFromRequest('media')
                ->sanitizingFileName(function ($fileName) {
                    return \Str::slug($fileName);
                })->toMediaCollection($comment['id'] . '-comments');
        $this->actionSuccess();
        return redirect()->route('comment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        $this->actionSuccess();
        return back();
    }
}
