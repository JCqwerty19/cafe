<?php

namespace App\Repositories\Interfaces\Client;

// Import DTO
use App\DTO\Client\User\UserCreateDTO;
use App\DTO\Client\User\UserLoginDTO;
use App\DTO\Client\User\UserUpdateDTO;

interface UserRepositoryInterface
{
    // Make function
    public function make(UserCreateDTO $userCreateDTO): bool;

    // Signin function
    public function signin(UserLoginDTO $userLoginDTO): bool;

    // Renew function
    public function renew(UserUpdateDTO $userUpdateDTO): void;

    // Logout function
    public function logout(): void;

    // Delete function
    public function delete(int $user_id): bool;
}