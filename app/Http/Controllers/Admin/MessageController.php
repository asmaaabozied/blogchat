<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.messages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.messages.create');
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
            'type' => 'required',
            'message' => 'required',
            'from_id' => 'exists:users,id|nullable|required_if:type,Group,Normal',
            'to_id' => 'exists:users,id|nullable|required_if:type,Normal',
            'group_id' => 'exists:groups,id|required_if:type,Group|nullable|required_if:type,Group',
        ]);
        if ($request['type'] == 'Group')
            $request['to_id'] = null;
        if ($request['type'] == 'Normal')
            $request['group_id'] = null;

        Message::create($request->all());
        $this->actionSuccess();
        return redirect()->route('message.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Message $message
     * @return Response
     */
    public function show(Message $message)
    {
        return view('admin.messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Message $message
     * @return Response
     */
    public function edit(Message $message)
    {
        return view('admin.messages.edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Message $message
     * @return Response
     */
    public function update(Request $request, Message $message)
    {
        $request->validate([
            'type' => 'required',
            'message' => 'required',
            'from_id' => 'exists:users,id|nullable|required_if:type,Group,Normal',
            'to_id' => 'exists:users,id|nullable|required_if:type,Normal',
            'group_id' => 'exists:groups,id|required_if:type,Group|nullable|required_if:type,Group',
        ]);
        if ($request['type'] == 'Group')
            $request['to_id'] = null;
        if ($request['type'] == 'Normal')
            $request['group_id'] = null;

        $message->update($request->all());
        $this->actionSuccess();
        return redirect()->route('message.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Message $message
     * @return Response
     * @throws Exception
     */
    public function destroy(Message $message)
    {
        $message->delete();
        $this->actionSuccess();
        return back();
    }
}
