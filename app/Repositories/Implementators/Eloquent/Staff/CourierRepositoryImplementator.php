<?php

namespace App\Repositories\Implementators\Eloquent\Staff;

use App\Repositories\Interfaces\Staff\CourierRepository;
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


class CourierRepositoryImplementator implements CourierRepository
{
    // Courier make function
    public function make(CourierCreateDTO $courierCreateDTO): bool
    {
        // Check existanse couriers
        if (!$this->checkCouriers($courierCreateDTO->email)) {
            return false;
        }

        // Check trashed couriers
        $this->checkTash($courierCreateDTO->email);

        // Hash password
        $hashedPassword = $this->hashPassword($courierCreateDTO->password);

        // Collect courier data
        $courierData = $this->collectCourierParams($courierCreateDTO, $hashedPassword);

        // Make courier account
        $courier = $this->createCourier($courierData);

        // Login courier
        $this->courierLogin($courier);

        // return true if courier successfully registrated
        return true;
    }

    // Sigin function
    public function signin(CourierLoginDTO $courierLoginDTO): bool
    {
        // Collect courier data
        $courierLoginData = $this->collectCourierLoginParams($courierLoginDTO);

        // Sigin in courier
        return $this->courierLogin($courierLoginData);
    }

    // Renew courier info function
    public function renew(CourierUpdateDTO $courierUpdateDTO): void
    {
        // Find courier
        $courier = $this->findCourier($courierUpdateDTO->courier_id);

        // Hash new password
        $hashedPassword = $this->hashPassword($courierUpdateDTO->password);

        // Collect new courier data
        $courierData = $this->collectCourierUpdateParams($courierUpdateDTO, $hashedPassword);

        // Update courier data
        $this->updateCourier($courierData, $courier);
    }

    // Send link for password reset fucntion
    public function sendLink(string $email): void
    {
        // find user
        $courier = $this->findCourier($email);

        // generate passowrd reset token
        $token = $this->generatePasswordToken($courier);

        // create url
        $url = $this->createUrl($token, $courier->email);

        // create stdObject
        $object = $this->createStdObject($courier->email, $token, $url);

        // send link
        $this->mailLink($object);
    }

    // Password reset function
    public function reset(CourierPasswordResetDTO $courierDTO): void
    {
        $courier = $this->findCourier($courierDTO->email);

        $this->deleteToken($courier);

        $password = $this->hashPassword($courierDTO->password);

        $this->resetPassword($courier, $password);
    }

    // Logout function
    public function logout(): void
    {
        $this->logoutCourier();
    }

    // Courier delete function
    public function delete(int $courier_id): void
    {
        // Find courier
        $courier = $this->findCourier($courier_id);

        // Delete deliveries
        $this->deleteDeliveries($courier);

        // Delete courier
        $this->deleteCourier($courier);
    }

    // check couriers to it's existanse
    private function checkCouriers(string $email): bool
    {
        if (Courier::where('email', $email)->first()) {
            return false;
        } 

        return true;
    }

    // if courier already registrated and trashed force delete it
    private function checkTash(string $email): void
    {
        // find trashed couriers with given email
        $courier = Courier::onlyTrashed()->where('email', $email)->first();

        // delete if it's exist
        if ($courier) {
            $courier->forceDelete();
        }
    }

    // Collect courier create params
    private function collectCourierParams(CourierCreateDTO $courierCreateDTO, string $hashedPassword): array
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
    private function createCourier(array $courierData): Courier
    {
        return Courier::firstOrCreate(['email' => $courierData['email']], $courierData);
    }

    // Collect courier data for login
    private function collectCourierLoginParams(CourierLoginDTO $courierLoginDTO): array
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
    private function courierLogin($courier): ?bool
    {
        // if courier already exists
        if (is_array($courier)) {
            return Auth::guard('courier')->attempt($courier);
        }

        // if it's new courier
        return Auth::guard('courier')->login($courier);
    }

    // Collect new courier data
    private function collectCourierUpdateParams(CourierUpdateDTO $courierUpdateDTO, $hashedPassword): array
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
    private function updateCourier(array $courierData, $courier): void
    {
        $courier->update($courierData);
    }

    // generate password reset token function
    private function generatePasswordToken(Courier $courier): string
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
    private function deleteToken(Courier $courier): void
    {
        $courier->password_reset_token = null;
        $courier->save();
    }

    // create url function
    private function createUrl(string $token, string $email): string
    {
        return url('/courier/password/reset/' . $token . '/' . $email);
    }

    // create and return std object for mailer
    private function createStdObject(string $email, string $token, string $url): object
    {
        return (object) [
            'email' => $email,
            'token' => $token,
            'url' => $url,
        ];
    }

    // reset password
    private function resetPassword(Courier $courier, string $password): void
    {
        $courier->password = $password;
        $courier->save();
    }

    // send link
    private function mailLink(object $object): void
    {
        Mail::to($object->email)->send(new CourierPasswordReset($object));
    }

    // Logout courier function
    private function logoutCourier(): void
    {
        Auth::guard('courier')->logout();
    }

    // delete courier deliveries
    private function deleteDeliveries(Courier $courier): void
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
    private function deleteCourier(Courier $courier): void
    {
        $courier->delete();
    }

    // Find and return courier
    private function findcourier(int|string $courierData): Courier
    {
        // if input data id then find by id
        if (is_int($courierData)) {
            return Courier::find($courierData);
        }

        // else find by email
        return Courier::where('email', $courierData)->first();   
    }

    // Hash password
    private function hashPassword(?string $password): string
    {
        // if courier while creating or updating wrote new password hash it
        if ($password) {
            return Hash::make($password);
        }
        
        // if courier didnt write password while updating, then return current password 
        return Auth::guard('courier')->user()->password;
    }
}