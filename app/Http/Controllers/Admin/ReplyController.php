<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.replies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.replies.create');
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
            'repliable_type' => 'required',
            'repliable_id' => 'required',
            'content' => 'required',
            'user_id' => 'required|exists:users,id',
        ]);

        Reply::create($request->all());
        $this->actionSuccess();
        return redirect()->route('reply.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Reply $reply
     * @return Response
     */
    public function show(Reply $reply)
    {
        return view('admin.replies.show', compact('reply'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Reply $reply
     * @return Response
     */
    public function edit(Reply $reply)
    {
        return view('admin.replies.edit', compact('reply'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Reply $reply
     * @return Response
     */
    public function update(Request $request, Reply $reply)
    {
        $request->validate([
            'repliable_type' => 'required',
            'repliable_id' => 'required',
            'content' => 'required',
            'user_id' => 'required|exists:users,id',
        ]);

        $reply->update($request->all());
        $this->actionSuccess();
        return redirect()->route('reply.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Reply $reply
     * @return Response
     * @throws Exception
     */
    public function destroy(Reply $reply)
    {
        $reply->delete();
        $this->actionSuccess();
        return back();
    }
}
