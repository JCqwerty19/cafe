<?php

namespace App\DTO\Client\User;

class UserLoginDTO {

    // Construction user login DTO
    public function __construct(
        public string $email,
        public string $password,
    ) {
        $this->email = $email;
        $this->password = $password;
    }
}