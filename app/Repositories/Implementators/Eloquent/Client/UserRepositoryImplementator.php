<?php

namespace App\Repositories\Implementators\Eloquent\Client;

use App\Repositories\Interfaces\Client\UserRepositoryInterface;
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

    // Sigin function
    public function signin(UserLoginDTO $userLoginDTO): bool
    {
        // Collect user data
        $userLoginData = static::collectUserLoginParams($userLoginDTO);

        // Sigin in user and return it's result
        return static::userLogin($userLoginData); 
    }

    // User update function
    public function renew(UserUpdateDTO $userUpdateDTO): void
    {
        // Find user
        $user = static::findUser($userUpdateDTO->user_id);

        // Hash new password
        $hashedPassword = static::hashPassword($userUpdateDTO->password);

        // Collect new user data
        $userData = static::collectUserUpdateParams($userUpdateDTO, $hashedPassword, $user->status);

        // Update user data
        static::updateUser($userData, $user);
    }

    // Send link for password reset fucntion
    public function sendLink(string $email): void
    {
        // find user
        $user = static::findUser($email);

        // generate passowrd reset token
        $token = static::generatePasswordToken($user);

        // create url
        $url = static::createUrl($token, $user->email);

        // create stdObject
        $object = static::createStdObject($user->email, $token, $url);

        // send link
        static::mailLink($object);
    }

    // Password reset function
    public function reset(UserPasswordResetDTO $userDTO): void
    {
        $user = static::findUser($userDTO->email);

        static::deleteToken($user);

        $password = static::hashPassword($userDTO->password);

        static::resetPassword($user, $password);
    }

    // Logout function
    public function logout(): void
    {
        static::logoutUser();
    }

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

    // check trashed users
    public static function checkTash(string $email): void
    {
        // find trashed user
        $user = User::onlyTrashed()->where('email', $email)->first();
        
        // if user alerdy registrated and trashed, trash user
        if ($user) {
            $user->forceDelete();
        }
    }

    // Collect user create params in array
    public static function collectUserParams(UserCreateDTO $userCreateDTO, string $hashedPassword): array
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
    public static function createUser(array $userData): User
    {
        return User::firstOrCreate(['email' => $userData['email']], $userData);
    }

    // Collect user data for login in array
    public static function collectUserLoginParams(UserLoginDTO $userLoginDTO): array
    {
        return [
            'email' => $userLoginDTO->email,
            'password' => $userLoginDTO->password,
        ];
    }

    // Collect new user data in array
    public static function collectUserUpdateParams(UserUpdateDTO $userUpdateDTO, string $hashedPassword, string $status): array
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
    public static function updateUser(array $userData, $user): void
    {
        $user->update($userData);
    }

    // generate password reset token function
    public static function generatePasswordToken(User $user): string
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
    public static function deleteToken(User $user): void
    {
        $user->password_reset_token = null;
        $user->save();
    }

    // create url function
    public static function createUrl(string $token, string $email): string
    {
        return url('user/password/reset/' . $token . '/' . $email);
    }

    // create and return std object for mailer
    public static function createStdObject(string $email, string $token, string $url): object
    {
        return (object) [
            'email' => $email,
            'token' => $token,
            'url' => $url,
        ];
    }

    // reset password
    public static function resetPassword(User $user, string $password): void
    {
        $user->password = $password;
        $user->save();
    }

    // send link
    public static function mailLink(object $object): void
    {
        Mail::to($object->email)->send(new UserPasswordReset($object));
    }

    // Logout user function
    public static function logoutUser(): void
    {
        Auth::logout();
    }

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

    // Delete user account function
    public static function deleteUser(User $user): void
    {
        $user->delete();
    }

    // Find and return user
    public static function findUser(int|string $userData): User
    {
        // if input data id then find by id
        if (is_int($userData)) {
            return User::find($userData);
        }

        // else find by email
        return User::where('email', $userData)->first();   
    }

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