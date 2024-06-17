<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryList extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = false;
}
