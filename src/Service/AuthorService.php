<?php

namespace App\Service;

use App\Entity\Author;
use App\Repository\AuthorRepository;

class AuthorService
{

    public function __construct(
        private readonly AuthorRepository $authorRepository,
    ) {
    }

    public function findAuthorBookByName(string $name): array
    {
        if (strlen($name) < 3) {
            throw new \InvalidArgumentException(
                sprintf('Author name must be at least 3 characters long, %s given', $name)
            );
        }


        $author = $this->authorRepository->findOneBy(['name' => $name]);
        $booksArray = [];
        if (!$author) {
            throw new \InvalidArgumentException(
                sprintf('Author with name %s not found', $name)
            );
        }
        foreach ($author->getBooks() as $book) {
            $booksArray[] = [
                'id' => $book->getId(),
                'title' => $book->getTitle(),
                'publisher' => $book->getPublisher(),
                'pageCount' => $book->getPageCount(),
                'isPublic' => $book->IsPublic(),
            ];
        }

        return $booksArray;
    }

}