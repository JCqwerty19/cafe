<?php

namespace App\DTO\Staff\Courier;

class CourierCreateDTO {

    // Construction user create DTO
    public function __construct(
        public string $couriername,
        public string $email,
        public string $phone,
        public string $password,
    ) {
        $this->username = $couriername;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
    }
}