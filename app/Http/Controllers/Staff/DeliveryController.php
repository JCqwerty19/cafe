<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Staff\BaseController;
use Illuminate\Http\Request;

// Import models
use App\Models\Staff\Courier;
use App\Models\Client\Order;

// Import DTO
use App\DTO\Staff\Courier\CourierCreateDTO;
use App\DTO\Staff\Courier\CourierLoginDTO;
use App\DTO\Staff\Courier\CourierUpdateDTO;

// Import requests
use App\Http\Requests\Staff\Courier\CourierRegisterRequest;
use App\Http\Requests\Staff\Courier\CourierLoginRequest;
use App\Http\Requests\Staff\Courier\CourierUpdateRequest;

class DeliveryController extends BaseController
{
    // Register user
    public function register() {

        // Show register page
        return view('staff.delivery.courier.register');
    }

    // Make an account for user
    public function make(CourierRegisterRequest $courierRegusterRequest) {

        // Validate user register request data
        $courierData = $courierRegusterRequest->validated();

        // Create DTO to show user create data
        $courierCreateDTO = new CourierCreateDTO(
            couriername: $courierData['couriername'],
            email: $courierData['email'],
            phone: $courierData['phone'],
            password: $courierData['password'],
        );

        // Make an account through service
        $this->deliveryService->make($courierCreateDTO);
    }

    // Login User
    public function login() {

        // Show login page
        return view('staff.delivery.courier.login');
    }

    // Sign in user
    public function singin(CourierLoginRequest $courierLoginRequest) {

        // Validate user request data
        $courierData = $courierLoginRequest->validated();
        
        // Create DTO to show user sign in data
        $courierLoginDTO = new CourierLoginDTO(
            email: $courierData['email'],
            password: $courierData['password'],
        );

        // Login through service
        $this->deliveryService->singin($courierLoginDTO);
    }

    // User update
    public function update(Courier $courier) {

        $variables = [
            'courier' => $courier,
        ];

        // Show settings page
        return view('staff.delivery.courier.update');
    }

    // Renew user
    public function renew(CourierUpdateRequest $courierUpdateRequest) {

        // Valdate user request data
        $courierData = $courierUpdateRequest->validated();
        
        // Create DTO to show data for update user info
        $courierUpdateDTO = new CourierUpdateDTO(
            user_id: auth()->user()->id,
            couriername: $courierData['couriername'],
            email: $courierData['email'],
            phone: $courierData['phone'],
            password: $courierData['password'],
        );

        // Update user through service
        $this->deliveryService->renew($courierUpdateDTO);
    }

    // Logout courier
    public function logout(Courier $courier) {

        // Logoout courier through service
        $this->deliveryService->logout($courier->id);
    }

    // Delete an account
    public function delete(Courier $courier) {

        // Delete an account through service
        $this->deliveryService->delete($courier->id);
    }

    // Delivery table
    public function table() {
        $variables = [
            'orders' => Order::where('status', 'Your order waiting for courier')->get(),
        ];

        return view('staff.delivery.table', $variables);
    }

    public function deliver(Order $order) {
        $this->deliveryService->deliver($order->id);
    }

    public function list() {
        $variables = [
            'orders' => Deliveries::where('courier_id', auth()->user()->id)->get(),
        ];

        return view('staff.delivery.list');
    }


}
