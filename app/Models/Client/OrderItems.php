<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// import models
use App\Models\Client\Order;

class OrderItems extends Model
{
    // import traits
    use HasFactory, SoftDeletes;

    // Gaining access to CRUD order items
    protected $guarded = false;

    // get order function
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
