<?php

namespace App\Repositories\Implementators\Eloquent\Client;

use App\Repositories\Interfaces\Client\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Client\User;
use App\DTO\Client\User\UserCreateDTO;
use App\DTO\Client\User\UserLoginDTO;
use App\DTO\Client\User\UserUpdateDTO;
use App\DTO\Client\User\UserPasswordResetDTO;
use App\Mail\Client\User\UserPasswordReset;

class UserRepositoryImplementator implements UserRepository
{
    // User make function
    public function make(UserCreateDTO $userCreateDTO): bool
    {
        // Check existanse users
        if (!$this->checkUsers($userCreateDTO->email)) {
            return false;
        }

        // Check trashed users
        $this->checkTash($userCreateDTO->email);

        // Hash password
        $hashedPassword = $this->hashPassword($userCreateDTO->password);
        
        // Collect user data
        $userData = $this->collectUserParams($userCreateDTO, $hashedPassword);

        // Make user account
        $user = $this->createUser($userData);

        // Login user
        $this->userLogin($user);

        // return true (that user created successfully)
        return true;
    }

    // Sigin function
    public function signin(UserLoginDTO $userLoginDTO): bool
    {
        // Collect user data
        $userLoginData = $this->collectUserLoginParams($userLoginDTO);

        // Sigin in user and return it's result
        return $this->userLogin($userLoginData); 
    }

    // User update function
    public function renew(UserUpdateDTO $userUpdateDTO): void
    {
        // Find user
        $user = $this->findUser($userUpdateDTO->user_id);

        // Hash new password
        $hashedPassword = $this->hashPassword($userUpdateDTO->password);

        // Collect new user data
        $userData = $this->collectUserUpdateParams($userUpdateDTO, $hashedPassword, $user->status);

        // Update user data
        $this->updateUser($userData, $user);
    }

    // Send link for password reset fucntion
    public function sendLink(string $email): void
    {
        // find user
        $user = $this->findUser($email);

        // generate passowrd reset token
        $token = $this->generatePasswordToken($user);

        // create url
        $url = $this->createUrl($token, $user->email);

        // create stdObject
        $object = $this->createStdObject($user->email, $token, $url);

        // send link
        $this->mailLink($object);
    }

    // Password reset function
    public function reset(UserPasswordResetDTO $userDTO): void
    {
        $user = $this->findUser($userDTO->email);

        $this->deleteToken($user);

        $password = $this->hashPassword($userDTO->password);

        $this->resetPassword($user, $password);
    }

    // Logout function
    public function logout(): void
    {
        $this->logoutUser();
    }

    // User delete function
    public function delete(int $user_id): bool
    {
        // Find user
        $user = $this->findUser($user_id);

        if (!$this->checkOrders($user)) {
            return false;
        };

        // Delete user
        $this->deleteUser($user);

        return true;
    }

    // check user for existanse
    private function checkUsers(string $email): bool
    {
        // return false if user alerdy exist
        if (User::where('email', $email)->first()) {
            return false;
        }

        // return true if it's new user
        return true;
    }

    // check trashed users
    private function checkTash(string $email): void
    {
        // find trashed user
        $user = User::onlyTrashed()->where('email', $email)->first();
        
        // if user alerdy registrated and trashed, trash user
        if ($user) {
            $user->forceDelete();
        }
    }

    // Collect user create params in array
    private function collectUserParams(UserCreateDTO $userCreateDTO, string $hashedPassword): array
    {
        return [
            'username' => $userCreateDTO->username,
            'email' => $userCreateDTO->email,
            'phone' => $userCreateDTO->phone,
            'address' => $userCreateDTO->address,
            'password' => $hashedPassword,
            'status' => 'client',
        ];
    }

    // Create or return new or alredy created user (checking email)
    private function createUser(array $userData): User
    {
        return User::firstOrCreate(['email' => $userData['email']], $userData);
    }

    // Collect user data for login in array
    private function collectUserLoginParams(UserLoginDTO $userLoginDTO): array
    {
        return [
            'email' => $userLoginDTO->email,
            'password' => $userLoginDTO->password,
        ];
    }

    // Collect new user data in array
    private function collectUserUpdateParams(UserUpdateDTO $userUpdateDTO, string $hashedPassword, string $status): array
    {
        return [
            'username' => $userUpdateDTO->username,
            'email' => $userUpdateDTO->email,
            'phone' => $userUpdateDTO->phone,
            'address' => $userUpdateDTO->address,
            'password' => $hashedPassword,
            'status' => $status,
        ];
    }

    // Update user data
    private function updateUser(array $userData, $user): void
    {
        $user->update($userData);
    }

    // generate password reset token function
    private function generatePasswordToken(User $user): string
    {
        // generate token
        $token = Str::random(60);

        // put token into db
        $user->password_reset_token = $token;
        $user->save();

        // return generated token
        return $token;
    }

    // delete token function
    private function deleteToken(User $user): void
    {
        $user->password_reset_token = null;
        $user->save();
    }

    // create url function
    private function createUrl(string $token, string $email): string
    {
        return url('user/password/reset/' . $token . '/' . $email);
    }

    // create and return std object for mailer
    private function createStdObject(string $email, string $token, string $url): object
    {
        return (object) [
            'email' => $email,
            'token' => $token,
            'url' => $url,
        ];
    }

    // reset password
    private function resetPassword(User $user, string $password): void
    {
        $user->password = $password;
        $user->save();
    }

    // send link
    private function mailLink(object $object): void
    {
        Mail::to($object->email)->send(new UserPasswordReset($object));
    }

    // Logout user function
    private function logoutUser(): void
    {
        Auth::logout();
    }

    // check user to it's order existanse
    private function checkOrders(User $user): bool
    {
        // if there are opend orders. then do not delete user
        if ($user->orders()->exists()) {
            return false;
        }

        // if there are no orders then give access to delete
        return true;
    }

    // Delete user account function
    private function deleteUser(User $user): void
    {
        $user->delete();
    }

    // Find and return user
    private function findUser(int|string $userData): User
    {
        // if input data id then find by id
        if (is_int($userData)) {
            return User::find($userData);
        }

        // else find by email
        return User::where('email', $userData)->first();   
    }

    // Login function
    private function userLogin($user): ?bool
    {
        // if user already exists
        if (is_array($user)) {
            return Auth::attempt($user);
        }
        
        // if it's new user
        return Auth::login($user);
    }

    // Hash password
    private function hashPassword(?string $password): string
    {
        // if user while creating or updating wrote new password hash it
        if ($password) {
            return Hash::make($password);
        }

        // if userd didnt write password while updating, then return current password 
        return auth()->user()->password;
    }
}