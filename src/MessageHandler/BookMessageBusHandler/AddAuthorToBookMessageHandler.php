<?php

namespace App\MessageHandler\BookMessageBusHandler;

use App\Message\BookMessageBus\AddAuthorToBookMessage;
use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class AddAuthorToBookMessageHandler
{

    public function __construct(
        private readonly BookRepository $bookRepository,
        private readonly AuthorRepository $authorRepository,
    ) {
    }


    /**
     * @throws \Exception
     *
     */
    public function __invoke(AddAuthorToBookMessage $addAuthorToBookMessage): void
    {
        $author = $this->authorRepository->find($addAuthorToBookMessage->getAuthorId());

        $book = $this->bookRepository->find($addAuthorToBookMessage->getBookId());

        if(count($book->getAuthors()) > 3) {
            throw new \InvalidArgumentException(
                sprintf('Book can have maximum 3 authors, %s given', count($book->getAuthors()))
            );
        }


        if ($author && $book) {
            $book->addAuthor($author);
        } else {
            throw new \Exception('Author or Book not found');
        }

        $this->bookRepository->update($book);
    }

}