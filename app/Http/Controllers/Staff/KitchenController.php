<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Staff\BaseController;
use Illuminate\Http\Request;

// Import models
use App\Models\Client\Order;

class KitchenController extends BaseController
{
    // Show kitchen table page
    public function table()
    {
        // Objects for the kitchen table page
        $variables = [
            'orders' => Order::where('status', 'Preparing')->get(),
        ];

        // Show kitchen table page
        return view('staff.kitchen.table', $variables);
    }
}
