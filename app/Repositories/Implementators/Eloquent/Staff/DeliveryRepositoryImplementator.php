<?php

namespace App\Repositories\Implementators\Eloquent\Staff;

// Import interfaces
use App\Repositories\Interfaces\Staff\DeliveryRepositoryInterface;

// Import facades
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

// Import models
use App\Models\Client\Order;
use App\Models\Staff\Courier;
use App\Models\Staff\Deliveries;

// Import DTO
use App\DTO\Staff\Courier\CourierCreateDTO;
use App\DTO\Staff\Courier\CourierLoginDTO;
use App\DTO\Staff\Courier\CourierUpdateDTO;

class DeliveryRepositoryImplementator implements DeliveryRepositoryInterface
{
    // Courier make function
    public function make(CourierCreateDTO $courierCreateDTO): void {

        // Hash password
        $hashedPassword = static::hashPassword($courierCreateDTO->password);

        // Collect courier data
        $courierData = static::collectCourierParams($courierCreateDTO, $hashedPassword);

        // Make courier account
        $courier = static::createCourier($courierData);

        // Login courier
        static::courierLogin($courier);
    }

    // Sigin function
    public function signin(CourierLoginDTO $courierLoginDTO): void {

        // Collect courier data
        $courierLoginData = static::collectCourierLoginParams($courierLoginDTO);

        // Sigin in courier
        static::courierLogin($courierLoginData);
    }

    // Renew courier info function
    public function renew(CourierUpdateDTO $courierUpdateDTO): void {

        // Find courier
        $courier = static::findCourier($courierUpdateDTO->courier_id);

        // Hash new password
        $hashedPassword = static::hashPassword($courierUpdateDTO->password);

        // Collect new courier data
        $courierData = static::collectCourierUpdateParams($courierUpdateDTO, $hashedPassword);

        // Update courier data
        static::updateCourier($courierData, $courier);
    }

    // Logout function
    public function logout(): void {
        static::logoutCourier();
    }

    // Courier delete function
    public function delete(int $courier_id): void {

        // Find courier
        $courier = static::findCourier($courier_id);

        // Delete courier
        static::deleteCourier($courier);
    }

    public function deliver(int $order_id): void {
        $courier_id = Auth::guard('courier')->user()->id;

        $order = static::findOrder($order_id);

        static::changeStatus($order);

        static::deliverOrder($courier_id, $order_id);
    }

    // COURIER MAKE STATIC FUNCTIONS
    // ==================================================

    // Collect courier create params
    public static function collectCourierParams(CourierCreateDTO $courierCreateDTO, string $hashedPassword): array {

        // Collect courier data in array
        $courierData = [
            'couriername' => $courierCreateDTO->couriername,
            'email' => $courierCreateDTO->email,
            'phone' => $courierCreateDTO->phone,
            'password' => $hashedPassword,
        ];

        // Return data
        return $courierData;
    }

    // Create or return new or alredy created courier (checking email)
    public static function createCourier(array $courierData): Courier {
        return Courier::firstOrCreate(['email' => $courierData['email']], $courierData);
    }

    // COURIER SIGNIN STATIC FUNCTIONS
    // ===================================================

    // Collect courier data for login
    public static function collectCourierLoginParams(CourierLoginDTO $courierLoginDTO): array {

        // Collect courier data in array
        $courierLoginData = [
            'email' => $courierLoginDTO->email,
            'password' => $courierLoginDTO->password,
        ];

        // Return data
        return $courierLoginData;
    }

    // COURIER SIGNIN STATIC FUNCTIONS
    // ===================================================

    // Collect new courier data
    public static function collectCourierUpdateParams(CourierUpdateDTO $courierUpdateDTO, $hashedPassword): array {

        // Collect params in array
        $courierData = [
            'couriername' => $courierUpdateDTO->couriername,
            'email' => $courierUpdateDTO->email,
            'phone' => $courierUpdateDTO->phone,
            'password' => $hashedPassword,
        ];

        // Return it
        return $courierData;
    }

    // Update courier data
    public static function updateCourier(array $courierData, $courier): void {
        $courier->update($courierData);
    }

    // GENERAL STATIC FUNCTIONS
    // ===================================================

    // Find and return courier
    public static function findCourier(int $courier_id): Courier {
        return Courier::find($courier_id);
    }

    // Hash password
    public static function hashPassword(?string $password): string {
        if ($password !== null) {
            return Hash::make($password);
        }
        
        return Auth::guard('courier')->user()->password;
    }

    // Login function
    public static function courierLogin($courier): void {

        // Check which type courier (it's new courier or alredy created courier)
        if ($courier instanceof Courier) {
            Auth::guard('courier')->login($courier);
        } else {
            Auth::guard('courier')->attempt($courier);
        }
    }

    // Logout courier function
    public static function logoutCourier(): void {
        Auth::guard('courier')->logout();
    }

    // Delete courier account function
    public static function deleteCourier(Courier $courier): void {
        $courier->delete();
    }

    public function findOrder(int $order_id): Order {
        return Order::find($order_id);
    }

    public static function deliverOrder(int $courier_id, int $order_id) {
        $data = [
            'courier_id' => $courier_id,
            'order_id' => $order_id,
        ];

        Deliveries::create($data);
    }

    public function changeStatus(Order $order): void {
        $order->status = 'Courier will deliver it soon';
        $order->save();
    }
}