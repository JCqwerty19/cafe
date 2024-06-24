<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Client\BaseController;
use Illuminate\Http\Request;

// Import models
use App\Models\Admin\Product;
use App\Models\Client\Order;
use App\Models\Client\User;

// Import requests
use App\Http\Requests\Client\Order\OrderCreateRequest;

// Import DTO
use App\DTO\Client\Order\OrderCreateDTO;
use App\DTO\Client\Order\OrderItemsDTO;

class OrderController extends BaseController
{
    // Create order
    public function create() {
        
        // Objects for the create order page
        $variables = [
            'user' => auth()->user(),
            'products' => Product::all(),
        ];

        // Show create order page
        return view('client.main.order', $variables);
    }

    // Make order
    public function make(OrderCreateRequest $orderRequest) {

        // Validate order request data
        $orderData = $orderRequest->validated();

        // Create DTO to show params for making order
        $orderCreateDTO = new OrderCreateDTO(
            user_id: auth()->user()->id,
            obtaining: $orderData['obtaining'],
            phone: $orderData['phone'],
            address: $orderData['address'],
            total_price: $orderData['total_price'],
            additional_price: $orderData['additional_price'],
        );

        // Make order through service
        $order = $this->orderService->make($orderCreateDTO);

        // Create DTO to show params for putting order items
        $orderItemsDTO = new OrderItemsDTO(
            order_id: $order->id,
            items: $orderData['items'],
        );

        // Put order items through service
        $this->orderService->putOrderItems($orderItemsDTO);

        // return to the my orders page
        return redirect()->route('user.orders');
    }

    // Distribute order
    public function distirbute(Order $order) {

        // Distribute order through service
        $this->orderService->distirbute($order->id);

        // return to the kitchen table page
        return redirect()->route('kitchen.table');
    }

    // Delete order
    public function delete(Order $order) {

        // Delete order through service
        $response = $this->orderService->delete($order->id);

        // Cheking user's order statuses 
        if (!$response) {
            back()->withErrors(['delete' => 'Sorry, after preparing, order cannot be deleted']);
        }
        
        // Return back to the my orders page
        return back();
    }
}