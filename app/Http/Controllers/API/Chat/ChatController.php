<?php

namespace App\Http\Controllers\API\Chat;

use App\Events\SentMessagesEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\MessageCollection;
use App\Http\Resources\UserCollection;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{

    public function getUserMessages(Request $request, User $user)
    {
        $rec = $user->receivedMessages()->where('from_id', auth()->id())->get();
        $send = $user->sentMessages()->where('to_id', auth()->id())->get();
        return new MessageCollection($rec->concat($send));
    }

    public function sendMessage(Request $request, User $user)
    {
        $request->validate([
            'message' => 'required'
        ]);
        $message = Message::create([
            'message' => $request['message'],
            'from_id' => auth()->id(),
            'to_id' => $user['id'],
        ]);
        event((new SentMessagesEvent($message))->dontBroadcastToCurrentUser());
        return new MessageCollection(collect($message));
    }
}
