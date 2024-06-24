<?php

namespace App\Repositories\Implementators\Eloquent\Staff;

// Import interfaces
use App\Repositories\Interfaces\Staff\CourierRepositoryInterface;

// Import facades
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

// Import models
use App\Models\Staff\Courier;

// Import DTO
use App\DTO\Staff\Courier\CourierCreateDTO;
use App\DTO\Staff\Courier\CourierLoginDTO;
use App\DTO\Staff\Courier\CourierUpdateDTO;


class CourierRepositoryImplementator
{
    // Courier make function
    public function make(CourierCreateDTO $courierCreateDTO): bool
    {
        // Check existanse couriers
        if (!static::checkCouriers($courierCreateDTO->email)) {
            return false;
        }

        // Check trashed users
        static::checkTash($courierCreateDTO->email);

        // Hash password
        $hashedPassword = static::hashPassword($courierCreateDTO->password);

        // Collect courier data
        $courierData = static::collectCourierParams($courierCreateDTO, $hashedPassword);

        // Make courier account
        $courier = static::createCourier($courierData);

        // Login courier
        static::courierLogin($courier);

        // return true if courier successfully registrated
        return true;
    }


    // =============================================================


    // Sigin function
    public function signin(CourierLoginDTO $courierLoginDTO): bool
    {
        // Collect courier data
        $courierLoginData = static::collectCourierLoginParams($courierLoginDTO);

        // Sigin in courier
        return static::courierLogin($courierLoginData);
    }


    // =============================================================


    // Renew courier info function
    public function renew(CourierUpdateDTO $courierUpdateDTO): void
    {
        // Find courier
        $courier = static::findCourier($courierUpdateDTO->courier_id);

        // Hash new password
        $hashedPassword = static::hashPassword($courierUpdateDTO->password);

        // Collect new courier data
        $courierData = static::collectCourierUpdateParams($courierUpdateDTO, $hashedPassword);

        // Update courier data
        static::updateCourier($courierData, $courier);
    }


    // =============================================================


    // Logout function
    public function logout(): void
    {
        static::logoutCourier();
    }


    // =============================================================
    

    // Courier delete function
    public function delete(int $courier_id): void
    {
        // Find courier
        $courier = static::findCourier($courier_id);

        // Delete deliveries
        static::deleteDeliveries($courier);

        // Delete courier
        static::deleteCourier($courier);
    }



    // =============================================================
    // STATIC FUNCTIONS
    // =============================================================



    // COURIER MAKE STATIC FUNCTIONS
    // =============================================================


    // check couriers to it's existanse
    public static function checkCouriers(string $email): bool
    {
        if (Courier::where('email', $email)->first()) {
            return false;
        } 

        return true;
    }


    // =============================================================


    // if courier already registrated and trashed force delete it
    public static function checkTash(string $email): void
    {
        if (Courier::onlyTrashed()->where('email', $email)->first()) {
            $user->forceDelete();
        }
    }


    // =============================================================


    // Collect courier create params
    public static function collectCourierParams(CourierCreateDTO $courierCreateDTO, string $hashedPassword): array
    {
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
    public static function createCourier(array $courierData): Courier
    {
        return Courier::firstOrCreate(['email' => $courierData['email']], $courierData);
    }


    // COURIER SIGNIN STATIC FUNCTIONS
    // =============================================================


    // Collect courier data for login
    public static function collectCourierLoginParams(CourierLoginDTO $courierLoginDTO): array
    {
        // Collect courier data in array
        $courierLoginData = [
            'email' => $courierLoginDTO->email,
            'password' => $courierLoginDTO->password,
        ];

        // Return data
        return $courierLoginData;
    }


    // =============================================================
    

    // Login function
    public static function courierLogin($courier): ?bool
    {
        // if courier already exists
        if (is_array($courier)) {
            return Auth::guard('courier')->attempt($courier);
        }

        // if it's new courier
        return Auth::guard('courier')->login($courier);
    }


    // COURIER UPDATE STATIC FUNCTIONS
    // =============================================================


    // Collect new courier data
    public static function collectCourierUpdateParams(CourierUpdateDTO $courierUpdateDTO, $hashedPassword): array
    {
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


    // =============================================================


    // Update courier data
    public static function updateCourier(array $courierData, $courier): void
    {
        $courier->update($courierData);
    }


    // COURIER LOGOUT STATIC FUNCTIONS
    // =============================================================


    // Logout courier function
    public static function logoutCourier(): void
    {
        Auth::guard('courier')->logout();
    }


    // COURIER DELETE STATIC FUNCTIONS
    // =============================================================

    // delete courier deliveries
    public static function deleteDeliveries(Courier $courier): void
    {
        // get all courier deliveries
        $deliveries = $courier->deliveries;

        // change orders' statuses
        foreach ($deliveries as $delivery) {
            $order = $delivery->order;

            if ($order) {
                $order->status = 'Your order waiting for courier';
                $order->save();
            }
        }

        // delete deliveries
        $courier->deliveries()->delete();
    }


    // =============================================================


    // Delete courier account function
    public static function deleteCourier(Courier $courier): void
    {
        $courier->delete();
    }


    // GENERAL COURIER STATIC FUNCTIONS
    // =============================================================


    // Find and return courier
    public static function findCourier(int $courier_id): Courier
    {
        return Courier::find($courier_id);
    }


    // =============================================================


    // Hash password
    public static function hashPassword(?string $password): string
    {
        // if courier while creating or updating wrote new password hash it
        if ($password) {
            return Hash::make($password);
        }
        
        // if courier didnt write password while updating, then return current password 
        return Auth::guard('courier')->user()->password;
    }
}