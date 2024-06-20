<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Client\BaseController;
use Illuminate\Http\Request;

// Import models
use App\Models\Client\Product;
use App\Models\Client\Order;
use App\Models\Client\User;

// Import DTO
use App\DTO\Client\Order\OrderCreateDTO;
use App\DTO\Client\Order\OrderItemsDTO;

// Import requests
use App\Http\Requests\Client\Order\OrderCreateRequest;

class OrderController extends BaseController
{
    // Create order
    public function create() {
        
        // Objects for the create order page
        $variables = [
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
            address: $orderData['obtaining'],
            total_price: $orderData['total_price'],
            additional_price: $orderData['additional_price'],
        );

        // Make order through service
        $order = $this->orderService->make($orderCreateDTO);

        // Create DTO to show params for putting order items
        $orderItemsDTO = new OrderItemsDTO(
            order_id: $order->id,
            array: $orderData['items'],
        );

        // Put order items through service
        $this->orderService->putOrderItems($orderItemsDTO);
    }

    // List order
    public function list() {

        // Get current user
        $user = User::find(auth()->user()->id);
        
        // Objects for the list order page
        $variables = [
            'orders' => $user->orders()->get(),
        ];

        // Show list order page
        //return view('client.orders', $variables);
    }

    // Distribute order
    public function distirbute(Order $order) {

        // Distribute order through service
        $this->orderService->distirbute($order->id);
    }

    // Delete order
    public function delete(Order $order) {

        // Delete order through service
        $this->orderService->delete($order->id);
    }
}
