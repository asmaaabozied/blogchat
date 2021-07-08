<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Exception;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.posts.create');
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
            'content' => 'required',

        ]);

        $Post = Post::create($request->all());
//        $uuid = $this->unique_code(5);
        foreach ((array)$request['media'] as $item) {
            $media = $Post->addMedia($item)
                ->sanitizingFileName(function ($fileName) {
                    return \Str::slug($fileName);
                })->usingFileName(Carbon::now()->timestamp . '. ' . $item->getClientOriginalExtension())
                ->withCustomProperties(['content' => $request['content'],'cat_id' => $request['cat_id']])
                ->toMediaCollection($Post['id'] . '-videos');
//            $media->update(['cat_id' => $request['cat_id']]);
        }


        $this->actionSuccess();
        return response()->redirectToRoute('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return Response
     */
    public function update(Request $request, $id)
    {

        $post = Post::find($id);

        $request->validate([
            'content' => 'required',
        ]);
        $post->update($request->except(['_token','_method']));


//        $uuid = $this->unique_code(5);

                if ($request->hasFile('media')) {
                    foreach ((array)$request['media'] as $item) {
                        $media = $post->addMedia($item)
                            ->sanitizingFileName(function ($fileName) {
                                return \Str::slug($fileName);
                            })->usingFileName(Carbon::now()->timestamp . '. ' . $item->getClientOriginalExtension())
                            ->withCustomProperties(['content' => $request['content'], 'cat_id' => $request['cat_id'], 'user_id' => $request['user_id'], 'views' => $request['views']])
                            ->toMediaCollection($post['id'] . '-videos.');
//            $media->update(['cat_id' => $request['cat_id']]);
                    }
                }
        $this->actionSuccess();
        return response()->redirectToRoute('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return Response
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        $post->delete();
        $this->actionSuccess();
        return back();
    }
}
