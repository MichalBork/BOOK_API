<?php

namespace App\MessageHandler\BookMessageBusHandler;

use App\Entity\Book;
use App\Message\BookMessageBus\AddBookMessage;
use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class AddBookMessageHandler
{
    public function __construct(
        private readonly BookRepository $bookRepository,
        private readonly AuthorRepository $authorRepository,
    ) {
    }

    /**
     * @throws \Exception
     */
    public function __invoke(AddBookMessage $addBookMessage): void
    {
        try {
            $book = new Book(
                $addBookMessage->getTitle(),
                $addBookMessage->getPublisher(),
                $addBookMessage->getPageCount(),
                $addBookMessage->getIsPublic()
            );


            if (count($addBookMessage->getAuthors()) > 3) {
                throw new \InvalidArgumentException(
                    sprintf('Book can have maximum 3 authors, %s given', count($addBookMessage->getAuthors()))
                );
            }
            foreach ($addBookMessage->getAuthors() as $authorId) {
                $author = $this->authorRepository->find($authorId);
                if ($author) {
                    $book->addAuthor($author);
                } else {
                    throw new \Exception('Author not found');
                }
            }

            $this->bookRepository->save($book);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

}