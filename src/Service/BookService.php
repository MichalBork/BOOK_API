<?php

namespace App\Service;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\Collection;

class BookService
{

    public function __construct(
        private readonly BookRepository $bookRepository,
    ) {
    }


    public function getAllBooks(): array
    {
        $books = $this->bookRepository->findAll();
        $booksArray = [];
        foreach ($books as $book) {
            $booksArray[] = [
                'id' => $book->getId(),
                'title' => $book->getTitle(),
                'publisher' => $book->getPublisher(),
                'pageCount' => $book->getPageCount(),
                'isPublic' => $book->IsPublic(),
                'authors' =>$this->getAuthorsForBook($book->getAuthors()),
            ];
        }

        return $booksArray;
    }

    private function getAuthorsForBook(Collection $authors):array
    {
        $authorsArray = [];
        foreach ($authors as $author) {
            $authorsArray[] = [
                'id' => $author->getId(),
                'name' => $author->getName(),
                'countryOrigin' => $author->getCountryOrigin(),

            ];
        }
        return $authorsArray;
    }
}