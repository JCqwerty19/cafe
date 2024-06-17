<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Staff\BaseController;
use Illuminate\Http\Request;

use App\Models\Client\Order;

class KitchenController extends BaseController
{
    public function index() {

        $variables = [
            'orders' => Order::query()->where('status', 'Preparing')->get(),
        ];

        return view('staff.kitchen', $variables);
    }
}
