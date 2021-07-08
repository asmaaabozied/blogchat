<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityCollection;
use App\Http\Resources\MediaCollection;
use App\Http\Resources\UserCollection;
use App\Models\FollowerUser;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{


    public function following()
    {

        return new UserCollection(auth()->user()->following()->get());


    }

    public function users()
    {
        return new UserCollection(User::all()->except(auth()->id()));
    }

    public function followers()
    {
        return new UserCollection(auth()->user()->followers()->paginate(10));
    }

    public function follows()
    {
        return new UserCollection(auth()->user()->following()->paginate(10));
    }

    public function savedMedia()
    {
        return new MediaCollection(auth()->user()->savedMedia()->paginate(10));
    }

    public function profile()
    {
        return $this->getProfile(auth()->user());
    }

    public function getProfile(User $user)
    {
        return [
            'user' => $user,
            'media' => $user->media,
            'posts' => $user->posts,
            'saved_media_count' => $user->savedPost()->count(),
            'memory_media_count' => $user->memoryPost()->count(),
            'followers_count' => $user->followers()->count(),
            'following_count' => $user->following()->count(),
        ];
    }

    public function follow(User $user)
    {
        if (FollowerUser::where('user_id', $user->id)
            ->where('follower_id', auth()->id())
            ->exists())
        {
            return response('already followed', 422);
        }
        $follow = FollowerUser::create([
            'user_id' => $user->id,
            'follower_id' => auth()->id()
        ]);
        activity('follow')->causedBy(auth()->user())->performedOn($user)->log('You are now Following ' . $user->name);
        return response('successful');
    }

    public function unfollow(User $user)
    {
        if (!FollowerUser::where('user_id', $user->id)
            ->where('follower_id', auth()->id())
            ->exists())
        {
            return response('already unfollowed', 422);
        }
        FollowerUser::where('user_id', $user->id)->where('follower_id', auth()->id())->delete();
        Activity::where('log_name', 'follow')
            ->where('subject_type', User::class)
            ->where('subject_id', $user->id)
            ->where('causer_id', auth()->id())
            ->where('causer_type', User::class)
            ->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . auth()->id(),
            'password' => 'confirmed',
            'country_id' => 'required|exists:countries,id',
        ]);
        auth()->user()->update($request->all());
        if ($request->hasFile('profile'))
            auth()->user()->addMediaFromRequest('profile')
                ->sanitizingFileName(function ($fileName) {
                    return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
                })
                ->toMediaCollection('profile');
        return new UserCollection(auth()->user()->toArray());
    }

    public function getUserCommentActivity()
    {
        return new ActivityCollection(auth()->user()->commentActivities()->paginate(10));
    }

    public function getUserLikeActivity()
    {
        return new ActivityCollection(auth()->user()->likeActivities()->paginate(10));
    }

    public function getUserFollowActivity()
    {
        return new UserCollection(auth()->user()->followers()->wherePivot('is_accepted', false)->paginate(10));
    }

    public function acceptFollower(Request $request, User $follower, bool $flag)
    {
        auth()->user()->followers()->where('follower_id', $follower['id'])->update(['is_accepted' => $flag]);
        return new  UserCollection(auth()->user()->followers()->paginate(10));
    }
}

