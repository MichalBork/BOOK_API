<?php

namespace App\Message\BookMessageBus;

class AddBookMessage
{


    public function __construct(
        private readonly string $title,
        private readonly string $publisher,
        private readonly int $pageCount,
        private readonly bool $isPublic,
        private readonly array $authors,
    ) {
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getPublisher(): string
    {
        return $this->publisher;
    }

    public function getPageCount(): int
    {
        return $this->pageCount;
    }

    public function getIsPublic(): bool
    {
        return $this->isPublic;
    }

    public function getAuthors(): array
    {
        return $this->authors;
    }
}