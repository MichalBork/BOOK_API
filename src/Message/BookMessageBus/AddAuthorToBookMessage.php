<?php

namespace App\Message\BookMessageBus;

class AddAuthorToBookMessage
{


    public function __construct(
        private readonly int $bookId,
        private readonly int $authorId,
    ) {
    }

    public function getBookId(): int
    {
        return $this->bookId;
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
    }

}