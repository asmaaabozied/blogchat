<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/


Broadcast::channel('message-{from_id}-{to_id}', function ($user, $from_id, $to_id) {
    return (int)$user->id === (int)$from_id || (int)$user->id === (int)$to_id;
});
