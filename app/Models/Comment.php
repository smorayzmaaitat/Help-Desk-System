<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'ticket_id', 
        'user_id', 
        'content', 
        'user_name',   // Add this
        'user_role',
    ];


public function ticket()
{
    return $this->belongsTo(Ticket::class);  // A comment belongs to a ticket
}


}
