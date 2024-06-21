<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Staff\BaseController;
use Illuminate\Http\Request;

// Import models
use App\Models\Client\Order;

class PickupController extends BaseController
{
    // Show pickup table page
    public function table() {

        // Objects for the pickup table page
        $variables = [
            'orders' => Order::where('status', 'Your order waiting for you')->get(),
        ];

        // Show pickup table page
        return view('staff.pickup.table', $variables);
    }
}
