<?php

namespace App\DTO\Client\User;

class UserCreateDTO {

    // user create DTO construction
    public function __construct(
        public string $username,
        public string $email,
        public ?string $phone,
        public ?string $address,
        public string $password,
    ) {
        $this->username = $username;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->password = $password;
    }
}