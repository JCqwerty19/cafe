<?php

namespace App\Services\Staff;

// Import repository
use App\Repositories\Interfaces\Staff\DeliveryRepositoryInterface;

// Import DTO
use App\DTO\Staff\Courier\CourierCreateDTO;
use App\DTO\Staff\Courier\CourierLoginDTO;
use App\DTO\Staff\Courier\CourierUpdateDTO;


class DeliveryService
{
    public function __construct(
        public DeliveryRepositoryInterface $deliveryRepositoryInterface
    ) {
        $this->deliveryRepositoryInterface = $deliveryRepositoryInterface;
    }

    public function make(CourierCreateDTO $courierCreateDTO) {
        $courierCreateDTO = new CourierCreateDTO(
            couriername: $courierCreateDTO->couriername,
            email: $courierCreateDTO->email,
            phone: $courierCreateDTO->phone,
            password: $courierCreateDTO->password,
        );

        $this->deliveryRepositoryInterface->make($courierCreateDTO);
    }

    public function singin(CourierLoginDTO $courierLoginDTO) {
        $courierLoginDTO = new CourierLoginDTO(
            email: $courierLoginDTO->email,
            password: $courierLoginDTO->password,
        );

        $this->deliveryRepositoryInterface->signin($courierLoginDTO);
    }

    public function renew(CourierUpdateDTO $courierUpdateDTO): void {
        $courierUpdateDTO = new CourierUpdateDTO(
            user_id: $courierUpdateDTO->user_id,
            couriername: $courierUpdateDTO->couriername,
            email: $courierUpdateDTO->email,
            phone: $courierUpdateDTO->phone,
            password: $courierUpdateDTO->password,
        );

        $this->deliveryRepositoryInterface->renew($courierUpdateDTO);
    }

    // Logout courier
    public function logout(int $courier_id): void {

        // Logoout courier in repository
        $this->deliveryRepositoryInterface->logout($courier_id);
    }

    // Delete an account
    public function delete(int $courier_id): void {

        // Delete an account in repository
        $this->deliveryRepositoryInterface->delete($courier_id);
    }

    public function deliver(int $order_id): void {
        $this->deliveryRepositoryInterface->deliver($courier_id);
    }
}