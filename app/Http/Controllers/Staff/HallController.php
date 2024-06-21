<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Staff\BaseController;
use Illuminate\Http\Request;

// Import models
use App\Models\Client\Order;

class HallController extends BaseController
{
    public function index() {
        $variables = [
            'orders' => Order::where('obtaining', 'hall')->get(),
        ];

        return view('staff.hall.index', $variables);
    }

    public function table() {
        $variables = [
            'orders' => Order::where('obtaining', 'hall')->get(),
        ];

        return view('staff.hall.table', $variables);
    }
}