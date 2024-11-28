<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    // Define the table name if it doesn't follow Laravel's naming convention
     protected $table = 'tests';

    // If you want to allow mass assignment for these columns
    protected $fillable = ['name', 'email'];
}
