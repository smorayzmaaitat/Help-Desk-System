<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'message_id',
        'sender_id',
        'receiver_id',
        'content',
        'image',
        'time',
    ];

}
