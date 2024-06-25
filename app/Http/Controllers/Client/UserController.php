<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Client\BaseController;
use Illuminate\Http\Request;

// Import facades
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

// Import models
use App\Models\Client\Order;
use App\Models\Client\User;

// Import requests
use App\Http\Requests\Client\User\UserRegisterRequest;
use App\Http\Requests\Client\User\UserLoginRequest;
use App\Http\Requests\Client\User\UserUpdateRequest;
use App\Http\Requests\Client\User\UserEmailRequest;
use App\Http\Requests\Client\User\UserPasswordResetRequest;

// Import DTO
use App\DTO\Client\User\UserCreateDTO;
use App\DTO\Client\User\UserLoginDTO;
use App\DTO\Client\User\UserUpdateDTO;
use App\DTO\Client\User\UserPasswordResetDTO;

class UserController extends BaseController
{
    // Register user
    public function register()
    {
        return view('client.user.register');
    }


    // =============================================================


    // Make an account for user
    public function make(UserRegisterRequest $userRegusterRequest)
    {
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
        $response = $this->userService->make($userCreateDTO);

        // Checking user to existance of account
        if (!$response) {
            return back()->withErrors(['account' => 'You have been registrated']);
        }

        // Redirect to the main page
        return redirect()->route('main.index');
    }


    // =============================================================


    // Login User
    public function login()
    {
        // Show login page
        return view('client.user.login');
    }

    // Sign in user
    public function signin(UserLoginRequest $userLoginRequest)
    {
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
                return back()->withErrors(['password' => 'Incorrect password.']);
            }
    
            // User does not exist or some other error
            return back()->withErrors(['email' => 'You have not an account, register first']);
        }
    
        // If login successful
        return redirect()->route('main.index');
    }


    // =============================================================


    // User update
    public function update()
    {
        // Objects for the user update page
        $variables = [
            'user' => auth()->user(),
        ];

        // Show settings page
        return view('client.user.update', $variables);
    }


    // =============================================================


    // Renew user
    public function renew(UserUpdateRequest $userUpdateRequest)
    {
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

        // redirect to the main page
        return redirect()->route('main.index');
    }


    // =============================================================


    // Show email require page for password reset
    public function linkPage()
    {
        return view('client.user.password.request');
    }


    // =============================================================


    // Send email fucntion
    public function sendLink(UserEmailRequest $userEmailRequest)
    {
        // validate email data
        $emailData = $userEmailRequest->validated();

        // send link through service
        $this->userService->sendLink($emailData['email']);

        // return back to the email require page with message
        return back()->with('message', 'Password reset link has been sent to your email.');
    }


    // =============================================================


    // Reset page function
    public function resetPage(string $token, string $email)
    {
        // collect data for reset page
        $variables = [
            'token' => $token,
            'email' => $email
        ];

        // show reset page
        return view('client.user.password.reset', $variables);
    }


    // =============================================================


    // Reset password function
    public function reset(UserPasswordResetRequest $userPasswordResetRequest)
    {
        // validate user data
        $userData = $userPasswordResetRequest->validated();

        // create DTO to show user password reset data
        $userDTO = new UserPasswordResetDTO(
            email: $userData['email'],
            token: $userData['token'],
            password: $userData['password'],
        );

        // find user for checking it's token
        $user = User::where('email', $userDTO->email)->first();

        // check token
        if ($userDTO->token !== $user->password_reset_token){
            return back()->withErrors(['token' => 'something wrong, try again']);

            // check password match
        } else if ($userDTO->password !== $userData['password_confirmation']) {
            return back()->withErrors(['password' => 'passwords don\'t match']);
        }

        // reset password through service
        $this->userService->reset($userDTO);

        // retirect to the login page
        return redirect()->route('user.login');
    }


    // =============================================================


    // Logout user
    public function logout(User $user)
    {
        // Logoout user through service
        $this->userService->logout($user->id);

        // Redirect to the main page
        return redirect()->route('main.index');
    }


    // =============================================================


    // Delete an account
    public function delete(User $user)
    {
        // Delete an account through service
        $response = $this->userService->delete($user->id);

        // Checking user orders existamse
        if (!$response) {
            return back()->withErrors(['delete' => 'Account can\'t be deleted while there are open orders']);
        }

        // Redirect to the main page
        return redirect()->route('main.index');
    }


    // =============================================================
    

    // Show user orders function
    public function orders()
    {
        // Objects for the my orders page
        $variables = [
            'orders' => Order::where('user_id', auth()->user()->id)
            ->with('delivery.courier')
            ->get(),
        ];

        // Show my orders page
        return view('client.user.orders', $variables);
    }
}
