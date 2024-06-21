<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Client\Order;

class Deliveries extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function order() {
        return $this->belongsTo(Order::class);
    }
}
