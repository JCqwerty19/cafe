<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Client\OrderItems;
use App\Models\Staff\Deliveries;

use App\Models\Client\User;

class Order extends Model
{
    // Import traits
    use SoftDeletes;

    // Gaining access to CRUD producs
    protected $guarded = false;

    // Get order user function
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function items() {
        return $this->hasMany(OrderItems::class);
    }

    public function delivery() {
        return $this->hasOne(Deliveries::class, 'order_id');
    }
}
