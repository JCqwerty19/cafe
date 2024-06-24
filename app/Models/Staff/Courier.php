<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// import models
use App\Models\Staff\Deliveries;

class Courier extends Authenticatable
{
    // Import traits
    use Notifiable, HasFactory, SoftDeletes;

    // Get access to CRUD couriers
    protected $guarded = false;

    protected $fillable = [
        'couriername', 'email', 'phone', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function deliveries()
    {
        return $this->hasMany(Deliveries::class);
    }
}
