<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.groups.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        Group::create($request->all());
        $this->actionSuccess();
        return redirect()->route('group.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Group $group
     * @return Response
     */
    public function show(Group $group)
    {
        return view('admin.groups.show', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Group $group
     * @return Response
     */
    public function edit(Group $group)
    {
        return view('admin.groups.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Group $group
     * @return Response
     */
    public function update(Request $request, Group $group)
    {
        $group->update($request->all());
        $this->actionSuccess();
        return redirect()->route('group.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Group $group
     * @return Response
     * @throws Exception
     */
    public function destroy(Group $group)
    {
        $group->delete();
        $this->actionSuccess();
        return back();
    }
}
