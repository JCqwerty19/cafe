<?php

namespace App\DTO\Client\User;

class UserLoginDTO {

    // user login DTO construction
    public function __construct(
        public string $email,
        public string $password,
    ) {
        $this->email = $email;
        $this->password = $password;
    }
}