<?php

namespace App\Message\BookMessageBus;

class DeleteBookMessage
{

    public function __construct(
        private readonly int $id,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

}