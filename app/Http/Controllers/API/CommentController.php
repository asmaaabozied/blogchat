<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentStore;
use App\Http\Resources\CommentCollection;
use App\Http\Resources\ReplyCollection;
use App\Models\Comment;
use App\Models\Media;
use App\Models\Post;
use App\Q8\FileManager;
use Carbon\Carbon;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Activitylog\Models\Activity;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return CommentCollection
     */
    public function index()
    {
        return new  CommentCollection(auth()->user()->comments()->paginate(10));
    }


    public function likeMedia(Comment $comment)
    {
        $like = $comment->likes()->create([
            'user_id' => auth()->id(),
        ]);
        activity('like')->causedBy(auth()->user())->performedOn($comment)->log(auth()->user()->name . ' liked your comment');
        return $like->toArray();
    }


    public function dislikeMedia(Request $request, Comment $comment, bool $flag)
    {
        if ($flag) {
            $disLike = $comment->dislikes()->create([
                'user_id' => auth()->id(),
            ]);
            activity('dislike')->causedBy(auth()->user())->performedOn($comment)->log(auth()->user()->name . ' Disliked your post');
            return $disLike->toArray();

        } else {
            $comment->dislikes()->where('user_id', auth()->id())->delete();
            Activity::where('log_name', 'dislike')
                ->where('subject_type', Comment::class)
                ->where('subject_id', $comment->id)
                ->where('causer_id', auth()->id())
                ->where('causer_type', User::class)
                ->delete();
            return \response(null, \Symfony\Component\HttpFoundation\Response::HTTP_NO_CONTENT);
        }
    }

    public function removeLike(Comment $comment)
    {
        $comment->likes()->where('user_id', auth()->id())->delete();
        Activity::where('log_name', 'like')
            ->where('subject_type', Comment::class)
            ->where('subject_id', $comment->id)
            ->where('causer_id', auth()->id())
            ->where('causer_type', User::class)
            ->delete();
        return \response('comment like deleted', \Symfony\Component\HttpFoundation\Response::HTTP_NO_CONTENT);
    }


    public function removedisLike(Comment $comment)
    {
        $comment->dislikes()->where('user_id', auth()->id())->delete();
        Activity::where('log_name', 'like')
            ->where('subject_type', Comment::class)
            ->where('subject_id', $comment->id)
            ->where('causer_id', auth()->id())
            ->where('causer_type', User::class)
            ->delete();
        return \response('comment like deleted', \Symfony\Component\HttpFoundation\Response::HTTP_NO_CONTENT);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return CommentCollection
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function store(CommentStore $request)
    {
        $request['user_id'] = auth()->id();
        $comment = Comment::create($request->all());
        if ($request->hasFile('media'))
            foreach ($request['media'] as $item) {
                $comment->addMedia($item)
                    ->usingFileName(
                        FileManager::generateFileNameFromFile($item)
                    )
                    ->toMediaCollection('comments');
            }

        activity('comment')
            ->causedBy(auth()->user())
            ->performedOn(Post::find($request->post_id))
            ->log(auth()->user()->name . ' Commented on your post');
        return new CommentCollection(collect($comment->load(['familyBlog' => function ($query) {
            return $query->with('media');
        }])));
    }

    /**
     * Display the specified resource.
     *
     * @param Comment $comment
     * @return CommentCollection
     */
    public function show(Comment $comment)
    {
        return new  CommentCollection(collect($comment));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Comment $comment
     * @return CommentCollection
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function update(Comm $request, Comment $comment)
    {
        $comment->update($request->all());
        if ($request->hasFile('media'))
            foreach ($request['media'] as $item) {
                $comment->addMedia($item)
                    ->usingFileName(
                        FileManager::generateFileNameFromFile($item)
                    )
                    ->toMediaCollection('comments');
            }
        return new CommentCollection(collect($comment->load(['familyBlog' => function ($query) {
            return $query->with('media');
        }])));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return Response
     * @throws \Exception
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return \response(null, \Symfony\Component\HttpFoundation\Response::HTTP_NO_CONTENT);
    }

    public function getReplies(Request $request, Comment $comment)
    {
        return new  ReplyCollection($comment->replies()->paginate(10));
    }
}
