<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Client\Order;

class OrderItems extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = false;

    public function order() {
        return $this->belongsTo(Order::class);
    }
}
