<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Client\Order;

class DeliveryOrders extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = false;

    public function order() {
        return $this->belongsTo(Order::class);
    }
}
