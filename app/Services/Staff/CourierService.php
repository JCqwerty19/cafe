<?php

namespace App\Services\Staff;

// Import repository
use App\Repositories\Interfaces\Staff\CourierRepositoryInterface;

// Import DTO
use App\DTO\Staff\Courier\CourierCreateDTO;
use App\DTO\Staff\Courier\CourierLoginDTO;
use App\DTO\Staff\Courier\CourierUpdateDTO;


class CourierService
{
    // courier service construction
    public function __construct(
        public CourierRepositoryInterface $courierRepositoryInterface
    ) {
        $this->courierRepositoryInterface = $courierRepositoryInterface;
    }


    // =============================================================


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
        return $this->deliveryRepositoryInterface->make($courierCreateDTO);
    }


    // =============================================================


    // sigin function 
    public function singin(CourierLoginDTO $courierLoginDTO): bool
    {
        // create DTO to show courier data for logining 
        $courierLoginDTO = new CourierLoginDTO(
            email: $courierLoginDTO->email,
            password: $courierLoginDTO->password,
        );

        // login courier in repository
        return $this->deliveryRepositoryInterface->signin($courierLoginDTO);
    }


    // =============================================================


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
        $this->deliveryRepositoryInterface->renew($courierUpdateDTO);
    }


    // =============================================================


    // Logout courier
    public function logout(): void
    {
        $this->deliveryRepositoryInterface->logout();
    }


    // =============================================================


    // Delete an account
    public function delete(int $courier_id): void
    {
        $this->deliveryRepositoryInterface->delete($courier_id);
    }
}