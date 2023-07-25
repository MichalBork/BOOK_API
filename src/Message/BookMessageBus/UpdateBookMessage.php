<?php

namespace App\Message\BookMessageBus;

class UpdateBookMessage
{

    public function __construct(
        private readonly int $id,
        private readonly string $title,
        private readonly string $publisher,
        private readonly int $pageCount,
        private readonly bool $isPublic,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
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



}