<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Staff\BaseController;
use Illuminate\Http\Request;

// Import models
use App\Models\Client\Order;

class PickupController extends BaseController
{
    public function table() {
        $variables = [
            'orders' => Order::where('status', 'Your order waiting for you')->get(),
        ];

        return view('staff.pickup.table', $variables);
    }
}
