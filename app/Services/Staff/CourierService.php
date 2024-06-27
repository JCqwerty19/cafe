<?php

namespace App\Services\Staff;

use App\Repositories\Interfaces\Staff\CourierRepositoryInterface;
use App\DTO\Staff\Courier\CourierCreateDTO;
use App\DTO\Staff\Courier\CourierLoginDTO;
use App\DTO\Staff\Courier\CourierUpdateDTO;
use App\DTO\Staff\Courier\CourierPasswordResetDTO;

class CourierService
{
    // courier service construction
    public function __construct(
        public CourierRepositoryInterface $courierRepositoryInterface
    ) {
        $this->courierRepositoryInterface = $courierRepositoryInterface;
    }

    // create courier
    public function make(CourierCreateDTO $courierCreateDTO): bool
    {
        // create DTO to show courier data for creating
        $courierCreateDTO = new CourierCreateDTO(
            couriername: $courierCreateDTO->couriername,
            email: $courierCreateDTO->email,
            phone: $courierCreateDTO->phone,
            password: $courierCreateDTO->password,
        );

        // create courier in reposiitory
        return $this->courierRepositoryInterface->make($courierCreateDTO);
    }

    // sigin function 
    public function singin(CourierLoginDTO $courierLoginDTO): bool
    {
        // create DTO to show courier data for logining 
        $courierLoginDTO = new CourierLoginDTO(
            email: $courierLoginDTO->email,
            password: $courierLoginDTO->password,
        );

        // login courier in repository
        return $this->courierRepositoryInterface->signin($courierLoginDTO);
    }

    // renew courier function
    public function renew(CourierUpdateDTO $courierUpdateDTO): void
    {
        // create DTO to show courier data for updating
        $courierUpdateDTO = new CourierUpdateDTO(
            courier_id: $courierUpdateDTO->user_id,
            couriername: $courierUpdateDTO->couriername,
            email: $courierUpdateDTO->email,
            phone: $courierUpdateDTO->phone,
            password: $courierUpdateDTO->password,
        );

        // update courier through repository
        $this->courierRepositoryInterface->renew($courierUpdateDTO);
    }

    // Send link for password reset through repository
    public function sendLink(string $email): void
    {
        $this->courierRepositoryInterface->sendLink($email);
    }

    // Password reset function
    public function reset(CourierPasswordResetDTO $courierPasswordResetDTO): void
    {
        // create DTO to show user data
        $courierDTO = new CourierPasswordResetDTO(
            email: $courierPasswordResetDTO->email,
            token: $courierPasswordResetDTO->token,
            password: $courierPasswordResetDTO->password,
        );

        // reset password through repository
        $this->courierRepositoryInterface->reset($courierDTO);
    }

    // Logout courier
    public function logout(): void
    {
        $this->courierRepositoryInterface->logout();
    }

    // Delete an account
    public function delete(int $courier_id): void
    {
        $this->courierRepositoryInterface->delete($courier_id);
    }
}