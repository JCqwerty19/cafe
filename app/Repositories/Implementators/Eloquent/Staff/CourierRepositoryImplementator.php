<?php

namespace App\Repositories\Implementators\Eloquent\Staff;

use App\Repositories\Interfaces\Staff\CourierRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\Staff\Courier;
use App\DTO\Staff\Courier\CourierCreateDTO;
use App\DTO\Staff\Courier\CourierLoginDTO;
use App\DTO\Staff\Courier\CourierUpdateDTO;
use App\DTO\Staff\Courier\CourierPasswordResetDTO;
use App\Mail\Staff\Courier\CourierPasswordReset;


class CourierRepositoryImplementator implements CourierRepositoryInterface
{
    // Courier make function
    public function make(CourierCreateDTO $courierCreateDTO): bool
    {
        // Check existanse couriers
        if (!static::checkCouriers($courierCreateDTO->email)) {
            return false;
        }

        // Check trashed couriers
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

    // Sigin function
    public function signin(CourierLoginDTO $courierLoginDTO): bool
    {
        // Collect courier data
        $courierLoginData = static::collectCourierLoginParams($courierLoginDTO);

        // Sigin in courier
        return static::courierLogin($courierLoginData);
    }

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

    // Send link for password reset fucntion
    public function sendLink(string $email): void
    {
        // find user
        $courier = static::findCourier($email);

        // generate passowrd reset token
        $token = static::generatePasswordToken($courier);

        // create url
        $url = static::createUrl($token, $courier->email);

        // create stdObject
        $object = static::createStdObject($courier->email, $token, $url);

        // send link
        static::mailLink($object);
    }

    // Password reset function
    public function reset(CourierPasswordResetDTO $courierDTO): void
    {
        $courier = static::findCourier($courierDTO->email);

        static::deleteToken($courier);

        $password = static::hashPassword($courierDTO->password);

        static::resetPassword($courier, $password);
    }

    // Logout function
    public function logout(): void
    {
        static::logoutCourier();
    }

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

    // check couriers to it's existanse
    public static function checkCouriers(string $email): bool
    {
        if (Courier::where('email', $email)->first()) {
            return false;
        } 

        return true;
    }

    // if courier already registrated and trashed force delete it
    public static function checkTash(string $email): void
    {
        // find trashed couriers with given email
        $courier = Courier::onlyTrashed()->where('email', $email)->first();

        // delete if it's exist
        if ($courier) {
            $courier->forceDelete();
        }
    }

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

    // Update courier data
    public static function updateCourier(array $courierData, $courier): void
    {
        $courier->update($courierData);
    }

    // generate password reset token function
    public static function generatePasswordToken(Courier $courier): string
    {
        // generate token
        $token = Str::random(60);

        // put token into db
        $courier->password_reset_token = $token;
        $courier->save();

        // return generated token
        return $token;
    }

    // delete token function
    public static function deleteToken(Courier $courier): void
    {
        $courier->password_reset_token = null;
        $courier->save();
    }

    // create url function
    public static function createUrl(string $token, string $email): string
    {
        return url('/courier/password/reset/' . $token . '/' . $email);
    }

    // create and return std object for mailer
    public static function createStdObject(string $email, string $token, string $url): object
    {
        return (object) [
            'email' => $email,
            'token' => $token,
            'url' => $url,
        ];
    }

    // reset password
    public static function resetPassword(Courier $courier, string $password): void
    {
        $courier->password = $password;
        $courier->save();
    }

    // send link
    public static function mailLink(object $object): void
    {
        Mail::to($object->email)->send(new CourierPasswordReset($object));
    }

    // Logout courier function
    public static function logoutCourier(): void
    {
        Auth::guard('courier')->logout();
    }

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

    // Delete courier account function
    public static function deleteCourier(Courier $courier): void
    {
        $courier->delete();
    }

    // Find and return courier
    public static function findcourier(int|string $courierData): Courier
    {
        // if input data id then find by id
        if (is_int($courierData)) {
            return Courier::find($courierData);
        }

        // else find by email
        return Courier::where('email', $courierData)->first();   
    }

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