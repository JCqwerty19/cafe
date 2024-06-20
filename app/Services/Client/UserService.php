<?php

namespace App\Services\Client;

// Import repository interface
use App\Repositories\Interfaces\Client\UserRepositoryInterface;

// Import DTO
use App\DTO\Client\UserCreateDTO;
use App\DTO\Client\UserLoginDTO;
use App\DTO\Client\UserUpdateDTO;

class UserService
{
    // Construction order service
    public function __construct(
        public UserRepositoryInterface $userRepositoryInterface,
    ) {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }
    
    // User make function
    public function make(UserCreateDTO $userCreateDTO) {

        // Create DTO to show params for user creating
        $userCreateDTO = new UserCreateDTO(
            username: $userCreateDTO->username,
            email: $userCreateDTO->email,
            phone: $userCreateDTO->phone,
            address: $userCreateDTO->address,
            password: $userCreateDTO->password,
        );

        // Make user in repository
        $this->userRepositoryInterface->make($userCreateDTO);
    }

    // Signin function
    public function signin(UserLoginDTO $userLoginDTO) {

        // Create DTO to show params for login user
        $userLoginDTO = new UserLoginDTO(
            email: $userLoginDTO->email,
            password: $userLoginDTO->password,
        );

        // Login user in repository
        $this->userRepositoryInterface->signin($userLoginDTO);
    }

    // Renew function
    public function renew(UserUpdateDTO $userUpdateDTO) {

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
        $this->userRepositoryInterface->renew($userUpdateDTO);
    }

    // Logout function
    public function logout(int $user_id) {

        // Logoout user in repository
        $this->userRepositoryInterface->logout($user_id);
    }

    // Delete fucntion
    public function delete(int $user_id) {

        // Delete user in repository
        $this->userRepositoryInterface->delete($user_id);
    }
}