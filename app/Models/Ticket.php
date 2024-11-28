<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category',
        'priority',
        'department',
        'attachment',
        'user_id',
        'feedback',
        'status',
        'staff_id' ,
        'checked_by' ,
        'staff_notes' ,
        'staff_solutions' ,
        'resolved_by'  ,
        'resolved_at' ,
        'time_to_resolve'
    ];
}
