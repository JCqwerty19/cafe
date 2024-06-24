<?php

namespace App\DTO\Admin\Admin;

class AdminLoginDTO
{
    // admin login DTO construction
    public function __construct(
        public int $code,
        public string $password,
    ) {
        $this->code = $code;
        $this->password = $password;
    }
}