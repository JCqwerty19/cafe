<?php

namespace App\Repositories\Implementators\Eloquent\Client;

// Import facades
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// Import intefaces
use App\Repositories\Interfaces\Client\UserRepositoryInterface;

// Import models
use App\Models\Client\User;

// Import DTO
use App\DTO\Client\User\UserCreateDTO;
use App\DTO\Client\User\UserLoginDTO;
use App\DTO\Client\User\UserUpdateDTO;

class UserRepositoryImplementator implements UserRepositoryInterface
{
    // User make function
    public function make(UserCreateDTO $userCreateDTO): bool
    {
        // Check existanse users
        if (!static::checkUsers($userCreateDTO->email)) {
            return false;
        }

        // Check trashed users
        static::checkTash($userCreateDTO->email);

        // Hash password
        $hashedPassword = static::hashPassword($userCreateDTO->password);
        
        // Collect user data
        $userData = static::collectUserParams($userCreateDTO, $hashedPassword);

        // Make user account
        $user = static::createUser($userData);

        // Login user
        static::userLogin($user);

        // return true (that user created successfully)
        return true;
    }


    // =============================================================


    // Sigin function
    public function signin(UserLoginDTO $userLoginDTO): bool
    {
        // Collect user data
        $userLoginData = static::collectUserLoginParams($userLoginDTO);

        // Sigin in user and return it's result
        return static::userLogin($userLoginData); 
    }


    // =============================================================


    // User update function
    public function renew(UserUpdateDTO $userUpdateDTO): void
    {
        // Find user
        $user = static::findUser($userUpdateDTO->user_id);

        // Hash new password
        $hashedPassword = static::hashPassword($userUpdateDTO->password);

        // Collect new user data
        $userData = static::collectUserUpdateParams($userUpdateDTO, $hashedPassword);

        // Update user data
        static::updateUser($userData, $user);
    }

    
    // =============================================================


    // Logout function
    public function logout(): void
    {
        static::logoutUser();
    }

    
    // =============================================================


    // User delete function
    public function delete(int $user_id): bool
    {
        // Find user
        $user = static::findUser($user_id);

        if (!static::checkOrders($user)) {
            return false;
        };

        // Delete user
        static::deleteUser($user);

        return true;
    }



    // =============================================================
    // STATIC FUNCTIONS
    // =============================================================



    // USER MAKE STATIC FUNCTIONS
    // =============================================================


    // check user for existanse
    public static function checkUsers(string $email): bool
    {
        // return false if user alerdy exist
        if (User::where('email', $email)->first()) {
            return false;
        }

        // return true if it's new user
        return true;
    }


    // =============================================================


    // check trashed users
    public static function checkTash(string $email): void
    {
        // if user alerdy registrated and trashed, trash user
        if (User::onlyTrashed()->where('email', $email)->first()) {
            $user->forceDelete();
        }
    }


    // =============================================================


    // Collect user create params
    public static function collectUserParams(UserCreateDTO $userCreateDTO, string $hashedPassword): array
    {
        // Collect user data in array
        $userData = [
            'username' => $userCreateDTO->username,
            'email' => $userCreateDTO->email,
            'phone' => $userCreateDTO->phone,
            'address' => $userCreateDTO->address,
            'password' => $hashedPassword,
        ];

        // Return data
        return $userData;
    }


    // =============================================================


    // Create or return new or alredy created user (checking email)
    public static function createUser(array $userData): User
    {
        return User::firstOrCreate(['email' => $userData['email']], $userData);
    }


    // USER SIGNIN STATIC FUNCTIONS
    // =============================================================


    // Collect user data for login
    public static function collectUserLoginParams(UserLoginDTO $userLoginDTO): array
    {
        // Collect user data in array
        $userLoginData = [
            'email' => $userLoginDTO->email,
            'password' => $userLoginDTO->password,
        ];

        // Return data
        return $userLoginData;
    }


    // USER UPDATE STATIC FUNCTIONS
    // =============================================================


    // Collect new user data
    public static function collectUserUpdateParams(UserUpdateDTO $userUpdateDTO, $hashedPassword): array
    {
        // Collect params in array
        $userData = [
            'username' => $userUpdateDTO->username,
            'email' => $userUpdateDTO->email,
            'phone' => $userUpdateDTO->phone,
            'address' => $userUpdateDTO->address,
            'password' => $hashedPassword,
        ];

        // Return array
        return $userData;
    }


    // =============================================================


    // Update user data
    public static function updateUser(array $userData, $user): void
    {
        $user->update($userData);
    }


    // USER LOGOUT STATIC FUNCTIONS
    // =============================================================
    

    // Logout user function
    public static function logoutUser(): void
    {
        Auth::logout();
    }


    // USER DELETE STATIC FUNCTIONS
    // =============================================================


    // check user to it's order existanse
    public static function checkOrders(User $user): bool
    {
        // if there are opend orders. then do not delete user
        if ($user->orders()->exists()) {
            return false;
        }

        // if there are no orders then give access to delete
        return true;
    }


    // =============================================================


    // Delete user account function
    public static function deleteUser(User $user): void
    {
        $user->delete();
    }


    // GENERAL STATIC FUNCTIONS
    // =============================================================


    // Find and return user
    public static function findUser(int $user_id): User
    {
        return User::find($user_id);
    }


    // =============================================================


    // Login function
    public static function userLogin($user): ?bool
    {
        // if user already exists
        if (is_array($user)) {
            return Auth::attempt($user);
        }
        
        // if it's new user
        return Auth::login($user);
    }

    
    // =============================================================


    // Hash password
    public static function hashPassword(?string $password): string
    {
        // if user while creating or updating wrote new password hash it
        if ($password) {
            return Hash::make($password);
        }

        // if userd didnt write password while updating, then return current password 
        return auth()->user()->password;
    }
}