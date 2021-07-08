<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentCollection;
use App\Http\Resources\MediaCollection;
use App\Models\Media;
use App\Models\MemoryUser;
use App\Models\SavedUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Activitylog\Models\Activity;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class MediaCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return MediaCollection
     */
    public function index()
    {
        return new MediaCollection(auth()->user()->media->groupBy('collection_name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return MediaCollection
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function store(Request $request)
    {
        $request->validate([
            'media' => 'required',
        ]);
        $uuid = $this->unique_code(5);

        foreach ($request['media'] as $item) {
            $media = auth()->user()->addMedia($item)
                ->sanitizingFileName(function ($fileName) {
                    return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
                })->usingFileName(Carbon::now()->timestamp . '-' . $item->getClientOriginalName())
                ->withCustomProperties(['description' => $request['description']])
                ->toMediaCollection(auth()->id() . '-videos.' . $uuid);
            $media->update(['cat_id' => $request['cat_id']]);
        }
        return new MediaCollection(Media::where('collection_name', auth()->id() . '-videos.' . $uuid)->get());
    }

    /**
     * Display the specified resource.
     *
     * @param Media $media
     * @return MediaCollection
     */
    public function show(Media $media)
    {
        $collection = Media::where('collection_name', $media['collection_name'])->get();
        foreach ($collection as $video) {
            $video->update([
                'views' => $video['views'] + 1
            ]);
        }
        return new MediaCollection($collection);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Media $media
     * @return Response
     */
    public function update(Request $request, Media $media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Media $media
     * @return Response
     */
    public function destroy(Media $media)
    {
        auth()->user()->clearMediaCollection($media['collection_name']);
        return \response(null, \Symfony\Component\HttpFoundation\Response::HTTP_NO_CONTENT);
    }


    public function savedMedia()
    {
        return new MediaCollection(auth()->user()->savedMedia()->paginate(10)->groupBy('collection_name'));
    }

    public function memoryMedia()
    {
        return new MediaCollection(auth()->user()->memoryMedia()->paginate(10)->groupBy('collection_name'));
    }

    public function mediaComments(Request $request)
    {
        $request->validate([
            'media_id' => 'required|exists:media,id',
        ]);
        return new   CommentCollection(Media::find($request['media_id'])->comments()->with(['media', 'familyBlog'=>function($query){$query->with('media');}])->paginate(10));
    }

    public function likeMedia(Media $media)
    {
        $like = $media->likes()->create([
            'user_id' => auth()->id(),
        ]);
        activity('like')->causedBy(auth()->user())->performedOn($media)->log(auth()->user()->name . ' liked your post');
        return $like->toArray();
    }

    public function removeLike(Media $media)
    {
        $media->likes()->where('user_id', auth()->id())->delete();
        Activity::where('log_name', 'like')
            ->where('subject_type', Media::class)
            ->where('subject_id', $media->id)
            ->where('causer_id', auth()->id())
            ->where('causer_type', User::class)
            ->delete();
        return \response(null, \Symfony\Component\HttpFoundation\Response::HTTP_NO_CONTENT);
    }

    public function saveMedia(Media $media)
    {
        activity()->causedBy(auth()->user())->performedOn($media)->log('save media');
        return SavedUser::create([
            'user_id' => auth()->id(),
            'collection_name' => $media['collection_name'],
        ]);
    }

    public function unsaveMedia(Media $media)
    {
        activity()->causedBy(auth()->user())->performedOn($media)->log('unsave media');
        SavedUser::where('user_id', auth()->id())->where('collection_name', $media['collection_name'])->delete();
        return \response(null, \Symfony\Component\HttpFoundation\Response::HTTP_NO_CONTENT);
    }

    public function dislikeMedia(Request $request, Media $media, bool $flag)
    {
        if ($flag) {
            $disLike = $media->dislikes()->create([
                'user_id' => auth()->id(),
            ]);
            activity('dislike')->causedBy(auth()->user())->performedOn($media)->log(auth()->user()->name . ' Disliked your post');
            return $disLike->toArray();

        } else {
            $media->dislikes()->where('user_id', auth()->id())->delete();
            Activity::where('log_name', 'dislike')
                ->where('subject_type', Media::class)
                ->where('subject_id', $media->id)
                ->where('causer_id', auth()->id())
                ->where('causer_type', User::class)
                ->delete();
            return \response(null, \Symfony\Component\HttpFoundation\Response::HTTP_NO_CONTENT);
        }
    }

    public function memoryUnmemoryMedia(Request $request, Media $media, bool $flag)
    {
        if ($flag) {
            return MemoryUser::create([
                'user_id' => auth()->id(),
                'collection_name' => $media['collection_name'],
            ]);
        } else {
            MemoryUser::where('user_id', auth()->id())->where('collection_name', $media['collection_name'])->delete();
            return \response(null, \Symfony\Component\HttpFoundation\Response::HTTP_NO_CONTENT);
        }
    }
}
