<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Client\BaseController;
use Illuminate\Http\Request;

// Import models
use App\Models\User;

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
        $this->userService->signin($userLoginDTO);
    }

    // User update
    public function update() {

        // Show settings page
        return view('client.user.update');
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
    }

    // Logout user
    public function logout(User $user) {

        // Logoout user through service
        $this->userService->logout($user->id);
    }

    // Delete an account
    public function delete(User $user) {

        // Delete an account through service
        $this->userService->delete($user->id);
    }
}
