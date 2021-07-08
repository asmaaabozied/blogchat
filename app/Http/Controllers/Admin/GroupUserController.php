<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\GroupUser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GroupUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.group-user.create');
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
            'group_id' => 'required|exists:groups,id',
            'user_ids' => 'required|array|exists:users,id',
        ]);
        $group = Group::find($request['group_id']);
        $group->users()->syncWithoutDetaching($request['user_ids']);
        $this->actionSuccess();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param GroupUser $groupUser
     * @return Response
     */
    public function show(GroupUser $groupUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param GroupUser $groupUser
     * @return Response
     */
    public function edit(GroupUser $groupUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param GroupUser $groupUser
     * @return Response
     */
    public function update(Request $request, GroupUser $groupUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param GroupUser $groupUser
     * @return Response
     */
    public function destroy(GroupUser $groupUser)
    {
        //
    }
}
