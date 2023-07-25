<?php

namespace App\MessageHandler\BookMessageBusHandler;
use App\Message\BookMessageBus\DeleteBookMessage;
use App\Repository\BookRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class DeleteBookMessageHandler
{

    public function __construct(
        private readonly BookRepository $bookRepository,
    )
    {
    }


    /**
     * @throws \Exception
     */
    public function __invoke(DeleteBookMessage $deleteBookMessage): void
    {
        try {
            $book = $this->bookRepository->find($deleteBookMessage->getId());
            if ($book) {
                $this->bookRepository->delete($book);
            } else {
                throw new \Exception('Book not found');
            }
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

}