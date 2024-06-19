<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Model
{
    // Import traits
    use HasFactory;
    use SoftDeletes;

    // Gaining access to CRUD producs
    protected $guarded = false;
}
