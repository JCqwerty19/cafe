<?php

namespace App\DTO\Staff\Courier;

class CourierUpdateDTO {

    // Construction courier update DTO
    public function __construct(
        public int $courier_id,
        public string $couriername,
        public string $email,
        public string $phone,
        public ?string $password,
    ) {
        $this->user_id = $courier_id;
        $this->username = $couriername;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
    }
}