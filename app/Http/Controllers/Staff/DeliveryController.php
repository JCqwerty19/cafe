<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Staff\BaseController;
use Illuminate\Http\Request;

// Import facades
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// Import models
use App\Models\Staff\Courier;
use App\Models\Staff\Deliveries;
use App\Models\Client\Order;

// Import requests
use App\Http\Requests\Staff\Courier\CourierRegisterRequest;
use App\Http\Requests\Staff\Courier\CourierLoginRequest;
use App\Http\Requests\Staff\Courier\CourierUpdateRequest;

// Import DTO
use App\DTO\Staff\Courier\CourierCreateDTO;
use App\DTO\Staff\Courier\CourierLoginDTO;
use App\DTO\Staff\Courier\CourierUpdateDTO;


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
        $response = $this->deliveryService->make($courierCreateDTO);

        // Checking courier to it's alredy been registrated
        if (!$response) {
            return redirect()->route('delivery.register')
                ->withErrors(['account' => 'You have been registrated']);
        }

        // Redirect to the delivery table page
        return redirect()->route('delivery.table');
    }

    // Login User
    public function login() {

        // Show login page
        return view('staff.delivery.courier.login');
    }

    // Sign in user
    public function signin(CourierLoginRequest $courierLoginRequest) {

        // Validate user request data
        $courierData = $courierLoginRequest->validated();
        
        // Create DTO to show user sign in data
        $courierLoginDTO = new CourierLoginDTO(
            email: $courierData['email'],
            password: $courierData['password'],
        );

        // Login through service
        $response = $this->deliveryService->singin($courierLoginDTO);

        // Show errors if login failed
        if (!$response) {

            // Check if user exists but the password is incorrect
            $courier = Courier::where('email', $courierData['email'])->first();
            if ($courier && !Hash::check($courierData['password'], $courier->password)) {

                // Incorrect password
                return redirect()->route('delivery.login')
                    ->withErrors(['password' => 'Incorrect password.']);
            }
    
            // User does not exist or some other error
            return redirect()->route('delivery.login')
                ->withErrors(['email' => 'You have not an account, register first']);
        }
    
        // If login successful
        return redirect()->route('delivery.table');
    }

    // User update
    public function update() {

        $variables = [
            'courier' => Auth::guard('courier')->user(),
        ];

        // Show settings page
        return view('staff.delivery.courier.update', $variables);
    }

    // Renew user
    public function renew(CourierUpdateRequest $courierUpdateRequest) {

        // Valdate user request data
        $courierData = $courierUpdateRequest->validated();
        
        // Create DTO to show data for update user info
        $courierUpdateDTO = new CourierUpdateDTO(
            courier_id: Auth::guard('courier')->user()->id,
            couriername: $courierData['couriername'],
            email: $courierData['email'],
            phone: $courierData['phone'],
            password: $courierData['password'],
        );

        // Update user through service
        $this->deliveryService->renew($courierUpdateDTO);

        // Redirect to the delivery table page
        return redirect()->route('delivery.table');
    }

    // Logout courier
    public function logout() {

        // Logoout courier through service
        $this->deliveryService->logout();

        // Redirect to the courier login page
        return redirect()->route('delivery.login');
    }

    // Delete an account
    public function delete() {

        // Delete an account through service
        $this->deliveryService->delete(Auth::guard('courier')->user()->id);

        // Redirect to the courier register page
        return redirect()->route('delivery.register');
    }

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