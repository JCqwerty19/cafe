<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Client\BaseController;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

// Import models
use App\Models\User;
use App\Models\Client\Order;

// Import DTO
use App\DTO\Client\User\UserCreateDTO;
use App\DTO\Client\User\UserLoginDTO;
use App\DTO\Client\User\UserUpdateDTO;

// Import requests
use App\Http\Requests\Client\User\UserRegisterRequest;
use App\Http\Requests\Client\User\UserLoginRequest;
use App\Http\Requests\Client\User\UserUpdateRequest;

class UserController extends BaseController
{
    // Register user
    public function register() {

        // Show register page
        return view('client.user.register');
    }

    // Make an account for user
    public function make(UserRegisterRequest $userRegusterRequest) {

        // Validate user register request data
        $userData = $userRegusterRequest->validated();


        // Create DTO to show user create data
        $userCreateDTO = new UserCreateDTO(
            username: $userData['username'],
            email: $userData['email'],
            phone: $userData['phone'],
            address: $userData['address'],
            password: $userData['password'],
        );

        // Make an account through service
        $this->userService->make($userCreateDTO);

        return redirect()->route('main.index');
    }

    // Login User
    public function login() {

        // Show login page
        return view('client.user.login');
    }

    // Sign in user
    public function signin(UserLoginRequest $userLoginRequest) {

        // Validate user request data
        $userData = $userLoginRequest->validated();
        
        // Create DTO to show user sign in data
        $userLoginDTO = new UserLoginDTO(
            email: $userData['email'],
            password: $userData['password'],
        );

        // Login through service
        $response = $this->userService->signin($userLoginDTO);

        // Show errors if login failed
        if (!$response) {
            // Check if user exists but the password is incorrect
            $user = User::where('email', $userData['email'])->first();
            if ($user && !Hash::check($userData['password'], $user->password)) {
                // Incorrect password
                return redirect()->route('user.login')->withErrors(['password' => 'Incorrect password.']);
            }
    
            // User does not exist or some other error
            return redirect()->route('user.login')->withErrors(['email' => 'You have not an account, register first']);
        }
    
        // If login successful
        return redirect()->route('main.index');
    }

    // User update
    public function update() {

        $variables = [
            'user' => auth()->user(),
        ];

        // Show settings page
        return view('client.user.update', $variables);
    }

    // Renew user
    public function renew(UserUpdateRequest $userUpdateRequest) {

        // Valdate user request data
        $userData = $userUpdateRequest->validated();
        
        // Create DTO to show data for update user info
        $userUpdateDTO = new UserUpdateDTO(
            user_id: auth()->user()->id,
            username: $userData['username'],
            email: $userData['email'],
            phone: $userData['phone'],
            address: $userData['address'],
            password: $userData['password'],
        );

        // Update user through service
        $this->userService->renew($userUpdateDTO);

        return redirect()->route('main.index');
    }

    // Logout user
    public function logout(User $user) {

        // Logoout user through service
        $this->userService->logout($user->id);

        return redirect()->route('main.index');
    }

    // Delete an account
    public function delete(User $user) {

        // Delete an account through service
        $this->userService->delete($user->id);

        return redirect()->route('main.index');
    }

    public function orders() {
        $variables = [
            'orders' => Order::where('user_id', auth()->user()->id)->get(),
        ];

        return view('client.user.orders', $variables);
    }
}
