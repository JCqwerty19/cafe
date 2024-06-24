<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Staff\BaseController;
use Illuminate\Http\Request;

// Import models
use App\Models\Client\Order;

class HallController extends BaseController
{
    // Show hall list page function
    public function index()
    {
        // Object for the hall list page
        $variables = [
            'orders' => Order::where('obtaining', 'hall')->get(),
        ];

        // Show hall list page
        return view('staff.hall.index', $variables);
    }


    // =============================================================
    

    // Show hall table page function
    public function table()
    {
        // Object for the hall table page
        $variables = [
            'orders' => Order::where('obtaining', 'hall')->get(),
        ];

        // Show hall table page
        return view('staff.hall.table', $variables);
    }
}