<?php

namespace App\Http\Controllers\Staff\Delivery;

use App\Http\Controllers\Staff\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Staff\Courier;
use App\Http\Requests\Staff\Courier\CourierRegisterRequest;
use App\Http\Requests\Staff\Courier\CourierLoginRequest;
use App\Http\Requests\Staff\Courier\CourierUpdateRequest;
use App\Http\Requests\Staff\Courier\CourierEmailRequest;
use App\Http\Requests\Staff\Courier\CourierPasswordResetRequest;
use App\DTO\Staff\Courier\CourierCreateDTO;
use App\DTO\Staff\Courier\CourierLoginDTO;
use App\DTO\Staff\Courier\CourierUpdateDTO;
use App\DTO\Staff\Courier\CourierPasswordResetDTO;

class CourierController extends BaseController
{
    // Register courier
    public function register()
    {
        return view('staff.delivery.courier.register');
    }

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

    // Login courier
    public function login()
    {
        // Show login page
        return view('staff.delivery.courier.login');
    }

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

    // courier update
    public function update()
    {
        $variables = [
            'courier' => Auth::guard('courier')->user(),
        ];

        // Show settings page
        return view('staff.delivery.courier.update', $variables);
    }

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

    // Show email require page for password reset
    public function linkPage()
    {
        return view('staff.delivery.courier.password.request');
    }

    // Send email fucntion
    public function sendLink(CourierEmailRequest $courierEmailRequest)
    {
        // validate email data
        $emailData = $courierEmailRequest->validated();

        // send link through service
        $this->courierService->sendLink($emailData['email']);

        // return back to the email require page with message
        return back()->with('message', 'Password reset link has been sent to your email.');
    }

    // Reset page function
    public function resetPage(string $token, string $email)
    {
        // collect data for reset page
        $variables = [
            'token' => $token,
            'email' => $email
        ];

        // show reset page
        return view('staff.delivery.courier.password.reset', $variables);
    }

    // Reset password function
    public function reset(CourierPasswordResetRequest $courierPasswordResetRequest)
    {
        // validate courier data
        $courierData = $courierPasswordResetRequest->validated();

        // create DTO to show courier password reset data
        $courierDTO = new CourierPasswordResetDTO(
            email: $courierData['email'],
            token: $courierData['token'],
            password: $courierData['password'],
        );

        // find courier for checking it's token
        $courier = Courier::where('email', $courierDTO->email)->first();

        // check token
        if ($courierDTO->token !== $courier->password_reset_token){
            return back()->withErrors(['token' => 'something wrong, try again']);

            // check password match
        } else if ($courierDTO->password !== $courierData['password_confirmation']) {
            return back()->withErrors(['password' => 'passwords don\'t match']);
        }

        // reset password through service
        $this->courierService->reset($courierDTO);

        // retirect to the login page
        return redirect()->route('courier.login');
    }

    // Logout courier
    public function logout()
    {
        // Logoout courier through service
        $this->courierService->logout();

        // Redirect to the courier login page
        return redirect()->route('courier.login');
    }

    // Delete an account
    public function delete(Courier $courier)
    {
        // Delete an account through service
        $this->courierService->delete($courier->id);

        // Redirect to the courier register page
        return back();
    }
}
