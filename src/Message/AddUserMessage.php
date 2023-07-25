<?php

namespace App\Message;

class AddUserMessage
{


    public function __construct(
        private readonly string $username,
        private readonly string $token,
    ) {
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getToken(): string
    {
        return $this->token;
    }


}