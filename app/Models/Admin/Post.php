<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    // Import traits
    use HasFactory, SoftDeletes;

    // Gaining access to CRUD posts
    protected $guarded = false;
}
