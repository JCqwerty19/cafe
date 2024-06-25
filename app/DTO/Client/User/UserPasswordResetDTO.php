<?php

namespace App\DTO\Client\User;

class UserPasswordResetDTO
{
    // User password reset DTO construction
    public function __construct(
        public string $email,
        public string $token,
        public string $password,
    ) {
        $this->email = $email;
        $this->token = $token;
        $this->password = $password;
    }
}