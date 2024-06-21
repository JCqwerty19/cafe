<?php

namespace App\DTO\Client\User;

class UserUpdateDTO {

    // Construction user update DTO
    public function __construct(
        public int $user_id,
        public string $username,
        public string $email,
        public ?string $phone,
        public ?string $address,
        public ?string $password,
    ) {
        $this->user_id = $user_id;
        $this->username = $username;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->password = $password;
    }
}