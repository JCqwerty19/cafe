<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// import models
use App\Models\Client\Order;
use App\Models\Staff\Courier;

class Deliveries extends Model
{
    // import traits
    use HasFactory, SoftDeletes;

    // Get access to CRUD deliveries
    protected $guarded = false;

    // Get courier function
    public function courier()
    {
        return $this->belongsTo(Courier::class);
    }

    // =============================================================

    // get order function
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
