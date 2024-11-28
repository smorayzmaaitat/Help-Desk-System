<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',  // the recipient user
        'title',    // notification title
        'content',  // notification content
        'sender_id', // the user who sent the notification
        'sent_at',  // timestamp for when it was sent
    ];
}
