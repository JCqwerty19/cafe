<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Client\OrderItems;
use APp\Models\Staff\DeliveryOrders;

class Order extends Model
{
    // Import traits
    use SoftDeletes;

    // Gaining access to CRUD producs
    protected $guarded = false;

    // ========================================
    
    public function items() {
        return $this->hasMany(OrderItems::class);
    }

    public function delivery() {
        return $this->hasMany(DeliveryOrders::class);
    }
}
