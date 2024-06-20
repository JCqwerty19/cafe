<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Staff\BaseController;
use Illuminate\Http\Request;

// Import models
use App\Models\Client\Order;

class KitchenController extends BaseController
{
    public function table() {
        $variables = [
            'orders' => Order::where('status', 'Preparing')->get(),
        ];

        return view('staff.kitchen.table', $variables);
    }
}
