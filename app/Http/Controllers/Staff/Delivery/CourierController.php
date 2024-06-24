<?php

namespace App\Http\Controllers\Staff\Delivery;

use App\Http\Controllers\Staff\BaseController;
use Illuminate\Http\Request;

// Import facades
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// Import models
use App\Models\Staff\Courier;

// Import requests
use App\Http\Requests\Staff\Courier\CourierRegisterRequest;
use App\Http\Requests\Staff\Courier\CourierLoginRequest;
use App\Http\Requests\Staff\Courier\CourierUpdateRequest;

// Import DTO
use App\DTO\Staff\Courier\CourierCreateDTO;
use App\DTO\Staff\Courier\CourierLoginDTO;
use App\DTO\Staff\Courier\CourierUpdateDTO;

class CourierController extends BaseController
{
    // Register courier
    public function register()
    {
        return view('staff.delivery.courier.register');
    }


    // =============================================================


    // Make an account for courier
    public function make(CourierRegisterRequest $courierRegusterRequest)
    {
        // Validate courier register request data
        $courierData = $courierRegusterRequest->validated();

        // Create DTO to show courier create data
        $courierCreateDTO = new CourierCreateDTO(
            couriername: $courierData['couriername'],
            email: $courierData['email'],
            phone: $courierData['phone'],
            password: $courierData['password'],
        );

        // Make an account through service
        $response = $this->courierService->make($courierCreateDTO);

        // Checking courier to it's alredy been registrated
        if (!$response) {
            return back()->withErrors(['account' => 'You have been registrated']);
        }

        // Redirect to the delivery table page
        return redirect()->route('delivery.table');
    }


    // =============================================================


    // Login courier
    public function login()
    {
        // Show login page
        return view('staff.delivery.courier.login');
    }


    // =============================================================


    // Sign in courier
    public function signin(CourierLoginRequest $courierLoginRequest)
    {
        // Validate courier request data
        $courierData = $courierLoginRequest->validated();
        
        // Create DTO to show courier sign in data
        $courierLoginDTO = new CourierLoginDTO(
            email: $courierData['email'],
            password: $courierData['password'],
        );

        // Login through service
        $response = $this->courierService->singin($courierLoginDTO);

        // Show errors if login failed
        if (!$response) {

            // Check if courier exists but the password is incorrect
            $courier = Courier::where('email', $courierData['email'])->first();
            if ($courier && !Hash::check($courierData['password'], $courier->password)) {

                // Incorrect password
                return back()->withErrors(['password' => 'Incorrect password.']);
            }
    
            // courier does not exist or some other error
            return back()->withErrors(['email' => 'You have not an account, register first']);
        }
    
        // If login successful
        return redirect()->route('delivery.table');
    }


    // =============================================================


    // courier update
    public function update()
    {
        $variables = [
            'courier' => Auth::guard('courier')->user(),
        ];

        // Show settings page
        return view('staff.delivery.courier.update', $variables);
    }


    // =============================================================


    // Renew courier
    public function renew(CourierUpdateRequest $courierUpdateRequest)
    {
        // Valdate courier request data
        $courierData = $courierUpdateRequest->validated();
        
        // Create DTO to show data for update courier info
        $courierUpdateDTO = new CourierUpdateDTO(
            courier_id: Auth::guard('courier')->user()->id,
            couriername: $courierData['couriername'],
            email: $courierData['email'],
            phone: $courierData['phone'],
            password: $courierData['password'],
        );

        // Update courier through service
        $this->courierService->renew($courierUpdateDTO);

        // Redirect to the delivery table page
        return redirect()->route('delivery.table');
    }


    // =============================================================


    // Logout courier
    public function logout()
    {
        // Logoout courier through service
        $this->courierService->logout();

        // Redirect to the courier login page
        return redirect()->route('courier.login');
    }


    // =============================================================
    

    // Delete an account
    public function delete(Courier $courier)
    {
        // Delete an account through service
        $this->courierService->delete($courier->id);

        // Redirect to the courier register page
        return back();
    }
}
