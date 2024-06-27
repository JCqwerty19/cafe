<?php

namespace App\Repositories\Interfaces\Client;

use App\DTO\Client\User\UserCreateDTO;
use App\DTO\Client\User\UserLoginDTO;
use App\DTO\Client\User\UserUpdateDTO;
use App\DTO\Client\User\UserPasswordResetDTO;

interface UserRepositoryInterface
{
    // Make function
    public function make(UserCreateDTO $userCreateDTO): bool;

    // Signin function
    public function signin(UserLoginDTO $userLoginDTO): bool;

    // Renew function
    public function renew(UserUpdateDTO $userUpdateDTO): void;

    // Send link for password reset function
    public function sendLink(string $email): void;

    // Reset password fucntion
    public function reset(UserPasswordResetDTO $userPasswordResetDTO): void;

    // Logout function
    public function logout(): void;

    // Delete function
    public function delete(int $user_id): bool;
}