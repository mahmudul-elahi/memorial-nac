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

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Private chat channel — only the two participants may subscribe
Broadcast::channel('chat.{idA}.{idB}', function ($user, $idA, $idB) {
    return (int) $user->id === (int) $idA || (int) $user->id === (int) $idB;
});
