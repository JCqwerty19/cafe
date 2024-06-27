<?php

namespace App\Services\Client;

use App\Repositories\Interfaces\Client\UserRepository;
use App\DTO\Client\User\UserCreateDTO;
use App\DTO\Client\User\UserLoginDTO;
use App\DTO\Client\User\UserUpdateDTO;
use App\DTO\Client\User\UserPasswordResetDTO;

class UserService
{
    // Construction order service
    public function __construct(
        public UserRepository $userRepository,
    ) {
        $this->userRepository = $userRepository;
    }
    
    // User make function
    public function make(UserCreateDTO $userCreateDTO): bool
    {
        // Create DTO to show params for user creating
        $userCreateDTO = new UserCreateDTO(
            username: $userCreateDTO->username,
            email: $userCreateDTO->email,
            phone: $userCreateDTO->phone,
            address: $userCreateDTO->address,
            password: $userCreateDTO->password,
        );

        // Make user in repository
        return $this->userRepository->make($userCreateDTO);
    }

    // Signin function
    public function signin(UserLoginDTO $userLoginDTO): bool
    {
        // Create DTO to show params for login user
        $userLoginDTO = new UserLoginDTO(
            email: $userLoginDTO->email,
            password: $userLoginDTO->password,
        );

        // Login user in repository
        return $this->userRepository->signin($userLoginDTO);
    }

    // Renew function
    public function renew(UserUpdateDTO $userUpdateDTO): void
    {
        // Create DTO to show params for user updating
        $userUpdateDTO = new UserUpdateDTO(
            user_id: $userUpdateDTO->user_id,
            username: $userUpdateDTO->username,
            email: $userUpdateDTO->email,
            phone: $userUpdateDTO->phone,
            address: $userUpdateDTO->address,
            password: $userUpdateDTO->password,
        );

        // Renew user info in repository
        $this->userRepository->renew($userUpdateDTO);
    }

    // Send link for password reset through repository
    public function sendLink(string $email): void
    {
        $this->userRepository->sendLink($email);
    }

    // Password reset function
    public function reset(UserPasswordResetDTO $userPasswordResetDTO): void
    {
        // create DTO to show user data
        $userDTO = new UserPasswordResetDTO(
            email: $userPasswordResetDTO->email,
            token: $userPasswordResetDTO->token,
            password: $userPasswordResetDTO->password,
        );

        // reset password through repository
        $this->userRepository->reset($userDTO);
    }

    // Logout function
    public function logout(): void
    {
        $this->userRepository->logout();
    }

    // Delete fucntion
    public function delete(int $user_id): void
    {
        $this->userRepository->delete($user_id);
    }
}