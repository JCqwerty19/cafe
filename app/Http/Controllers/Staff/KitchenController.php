<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Client\Order;

class KitchenController extends Controller
{
    public function index() {

        $variables = [
            'orders' => Order::query()->where('status', 'new_order')->get(),
        ];

        return view('staff.kitchen', $variables);
    }
}
