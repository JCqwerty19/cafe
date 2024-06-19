<?php

namespace App\DTO\Staff\Courier;

class CourierLoginDTO {

    // Construction user login DTO
    public function __construct(
        public string $email,
        public string $password,
    ) {
        $this->email = $email;
        $this->password = $password;
    }
}