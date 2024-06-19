<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    // Import traits
    use SoftDeletes;

    // Gaining access to CRUD producs
    protected $guarded = false;
}
