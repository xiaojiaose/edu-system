<?php

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

Broadcast::channel('room.{teacherId}.{studentId}', function (\App\User $user, $teacherId, $studentId) {
    logger(__FILE__, func_get_args());
    return true;
});
// siteMsg.5
Broadcast::channel('siteMsg.{id}', function ($user, $id) {
    logger(__FILE__, func_get_args());
    return (int) $user->id === (int) $id;
});
