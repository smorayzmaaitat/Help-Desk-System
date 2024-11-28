<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('comments', function ($user) {
    return true; // Allow all users to subscribe
});

Broadcast::channel('chat', function ($user) {
    return true; // Allow all users to subscribe
});


Broadcast::channel('notifications.{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
});