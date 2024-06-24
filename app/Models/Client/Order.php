<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// import models
use App\Models\Client\OrderItems;
use App\Models\Client\User;
use App\Models\Staff\Deliveries;

class Order extends Model
{
    // Import traits
    use HasFactory, SoftDeletes;

    // Gaining access to CRUD orders
    protected $guarded = false;

    // Get order user function
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // =============================================================

    // Get items function
    public function items()
    {
        return $this->hasMany(OrderItems::class);
    }

    // =============================================================

    // Get it's delivery function
    public function delivery()
    {
        return $this->hasOne(Deliveries::class, 'order_id');
    }
}
