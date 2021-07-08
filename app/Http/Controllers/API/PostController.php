<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStore;
use App\Http\Requests\PostUpdate;
use App\Http\Resources\ModelResource;
use App\Models\Media;
use App\Models\MemoryUser;
use App\Models\Post;
use App\Models\SavedUser;
use App\Models\User;
use App\Q8\FileManager;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Spatie\Activitylog\Models\Activity;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ModelResource
     */
    public function index()
    {
        //
        return ModelResource::make(Post::with('media')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostStore $request
     * @return ModelResource
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function store(PostStore $request)
    {
        $request['user_id'] = auth()->id();
        /** @var Post $post */
        $post = Post::create($request->all());
        /** @var File $item */
        if ($request->hasFile('media'))
        foreach ($request['media'] as $item) {
            $post->addMedia($item)
                ->usingFileName(
                    FileManager::generateFileNameFromFile($item)
                )
                ->toMediaCollection('posts');
        }
        return ModelResource::make($post->load('media'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return ModelResource
     */
    public function show($id)
    {
        return ModelResource::make(Post::with('media')->find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Post $post): JsonResponse
    {
        $post->delete();

        return response()->json
        ([
            'status' => 'deleted',
            'message' => trans('main.deleted'),
        ], 200);
    }


    public function savedPost(): ModelResource
    {
        return ModelResource::make((auth()->user()->savedPost()->paginate(10)));
    }

    public function getMemoryPosts(): ModelResource
    {
        return ModelResource::make(auth()->user()->memoryPost()->paginate(10));
    }


    public function postComments(Post $post): ModelResource
    {
        return ModelResource::make($post->comments()->with(['media', 'familyBlog' => function ($query) {
            $query->with('media');
        }])->paginate(10));
    }

    public function likePost(Post $post): ModelResource
    {
        $like = $post->likes()->create([
            'user_id' => auth()->id(),
        ]);
        activity('like')->causedBy(auth()->user())->performedOn($post)->log(auth()->user()->name . ' liked your post');
        return ModelResource::make($like);
    }

    public function removeLike(Post $post)
    {
        $post->likes()->where('user_id', auth()->id())->delete();
        Activity::where('log_name', 'like')
            ->where('subject_type', Post::class)
            ->where('subject_id', $post->id)
            ->where('causer_id', auth()->id())
            ->where('causer_type', User::class)
            ->delete();
        return response()->json
        ([
            'status' => 'removed',
            'message' => trans('main.removed'),
        ], 200);
    }

    public function savePost(Post $post)
    {
        activity()->causedBy(auth()->user())->performedOn($post)->log('save media');
        return SavedUser::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id
        ]);
    }

    public function unSavePost(Post $post)
    {
        activity()->causedBy(auth()->user())->performedOn($post)->log('unsave media');
        SavedUser::where('user_id', auth()->id())->where('post_id', $post->id)->delete();
        return response()->json
        ([
            'status' => 'unsaved',
            'message' => trans('main.unsaved'),
        ], 200);
    }

    public function disLikePost(Post $post)
    {
        $disLike = $post->dislikes()->create([
            'user_id' => auth()->id(),
        ]);
        activity('dislike')->causedBy(auth()->user())->performedOn($post)->log(auth()->user()->name . ' Disliked your post');
        return $disLike->toArray();

    }

    public function removeDislike(Post $post)
    {
        $post->dislikes()->where('user_id', auth()->id())->delete();
        Activity::where('log_name', 'dislike')
            ->where('subject_type', Media::class)
            ->where('subject_id', $post->id)
            ->where('causer_id', auth()->id())
            ->where('causer_type', User::class)
            ->delete();
        return response()->json
        ([
            'status' => 'removed',
            'message' => trans('main.removed'),
        ], 200);
    }

    public function addMemoryPost( Post $post)
    {
        return MemoryUser::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
        ]);

    }

    public function removeMemoryPost(Post $post)
    {
        MemoryUser::where('user_id', auth()->id())->where('post_id', $post->id)->delete();
        return response()->json
        ([
            'status' => 'removed',
            'message' => trans('main.removed'),
        ], 200);
    }



}
