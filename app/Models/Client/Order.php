<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Client\OrderItems;
use APp\Models\Staff\DeliveryOrders;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = false;

    public function items() {
        return $this->hasMany(OrderItems::class);
    }

    public function delivery() {
        return $this->hasMany(DeliveryOrders::class);
    }
}
