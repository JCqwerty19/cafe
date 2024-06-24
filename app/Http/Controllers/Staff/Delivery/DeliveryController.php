<?php

namespace App\Http\Controllers\Staff\Delivery;

use App\Http\Controllers\Staff\BaseController;
use Illuminate\Http\Request;

// Import facades
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// Import models
use App\Models\Staff\Deliveries;
use App\Models\Client\Order;

class DeliveryController extends BaseController
{
    // Delivery table
    public function table() {

        // Collect object for the delivery table page
        $variables = [
            'orders' => Order::where('status', 'Your order waiting for courier')->get(),
        ];

        // Show delivery table page
        return view('staff.delivery.table', $variables);
    }

    // Deliver function
    public function deliver(Order $order) {

        // Deliver function through service
        $this->deliveryService->deliver($order->id);

        // Show my delivery list page
        return redirect()->route('delivery.list');
    }

    // Show deliver list page function
    public function list() {

        // Collect object for the my delivery list page
        $variables = [
            'orders' => Deliveries::where('courier_id', Auth::guard('courier')->user()->id)
                ->with('order')
                ->get()
                ->pluck('order'),
        ];

        // Show deliver list page function
        return view('staff.delivery.list', $variables);
    }
}
