<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\GroupCollection;
use App\Models\Group;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return GroupCollection
     */
    public function index()
    {
        return new GroupCollection(auth()->user()->groups()->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return GroupCollection
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $group = Group::create($request->all());
        if ($request->hasFile('media'))
            $group->addMediaFromRequest('media')
                ->sanitizingFileName(function ($fileName) {
                    return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
                })->toMediaCollection('groups');

        $group->users()->syncWithoutDetaching([auth()->id() => ['is_admin' => true]]);
        $group->users()->syncWithoutDetaching($request['user_ids']);
        $group->load('users');
        return new GroupCollection(collect($group));
    }

    /**
     * Display the specified resource.
     *
     * @param Group $group
     * @return GroupCollection
     */
    public function show(Group $group)
    {
        if (auth()->user()->groups->contains($group->id))
            return new GroupCollection(collect($group));
        else
            return \response('You are not a group member', \Symfony\Component\HttpFoundation\Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Group $group
     * @return void
     */
    public function update(Request $request, Group $group)
    {
        if ($group->getAdminsAttribute()->contains(auth()->user())) {
            $group->update($request->all());
            if ($request->hasFile('media')) {
                $group->addMediaFromRequest('media')
                    ->sanitizingFileName(function ($fileName) {
                        return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
                    })->toMediaCollection('groups');
            }
            return new GroupCollection(collect($group));
        } else {
            abort(401, 'Not A Group Admin');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Group $group
     * @return void
     * @throws \Exception
     */
    public function destroy(Group $group)
    {
        abort_unless($group->getAdminsAttribute()->contains(auth()->user()), 403, 'You are not a group admin');
        $group->users()->sync([]);
        $group->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function addUsers(Request $request, Group $group)
    {
        $request->validate([
            'user_ids' => 'required',
        ]);
        $group->users()->syncWithoutDetaching($request['user_ids']);
        $group->refresh();
        return new GroupCollection(collect($group));
    }

    public function removeUsers(Request $request, Group $group)
    {
        $request->validate([
            'user_ids' => 'required'
        ]);
        $group->users()->detach($request['user_ids']);
        $group->refresh();
        return new GroupCollection(collect($group));
    }
}
