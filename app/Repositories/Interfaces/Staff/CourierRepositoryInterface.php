<?php

namespace App\Repositories\Interfaces\Staff;

// Import DTO
use App\DTO\Staff\Courier\CourierCreateDTO;
use App\DTO\Staff\Courier\CourierLoginDTO;
use App\DTO\Staff\Courier\CourierUpdateDTO;

interface CourierRepositoryInterface
{
    // Courier make function
    public function make(CourierCreateDTO $courierCreateDTO): bool;

    // Courier signin function
    public function signin(CourierLoginDTO $courierLoginDTO): bool;

    // Courier renew function
    public function renew(CourierUpdateDTO $courierUpdateDTO): void;

    // Courier logout function
    public function logout(): void;

    // Courier delete function
    public function delete(int $courier_id): void;
}