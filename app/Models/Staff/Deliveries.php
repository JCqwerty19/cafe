<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Client\Order;
use App\Models\Staff\Courier;

class Deliveries extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = false;

    public function courier() {
        return $this->belongsTo(Courier::class);
    }

    public function order() {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
