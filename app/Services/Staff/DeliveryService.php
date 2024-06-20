<?php

namespace App\Services\Staff;

// Import repository
use App\Repositories\Interfaces\Staff\DeliveryRepositoryInterface;

// Import DTO
use App\DTO\Staff\Delivery\DeliveryDTO;

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

    public function renew(CourierUpdateDTO $courierUpdateDTO) {
        $courierUpdateDTO = new CourierUpdateDTO(
            user_id: $courierUpdateDTO->user_id,
            couriername: $courierUpdateDTO->couriername,
            email: $courierUpdateDTO->email,
            phone: $courierUpdateDTO->phone,
            password: $courierUpdateDTO->password,
        );
    }

    // Logout courier
    public function logout(int $courier_id) {

        // Logoout courier in repository
        $this->deliveryService->logout($courier_id);
    }

    // Delete an account
    public function delete(int $courier_id) {

        // Delete an account in repository
        $this->deliveryService->delete($courier_id);
    }











    public function deliver(DeliveryDTO $deliveryDTO) {
        $deliveryDTO = new DeliveryDTO(
            courier_id: $deliveryDTO->getCourierId(),
            order_id: $deliveryDTO->getOrderId(),
        );

        $this->getDeliveryRepositoryInterface()->deliver($deliveryDTO);
    }
}