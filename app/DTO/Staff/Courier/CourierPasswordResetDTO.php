<?php

namespace App\DTO\Staff\Courier;

class CourierPasswordResetDTO
{
    // Courier password reset DTO construction
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