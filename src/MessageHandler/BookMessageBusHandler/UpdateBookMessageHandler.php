<?php

namespace App\MessageHandler\BookMessageBusHandler;

use App\Entity\Book;
use App\Message\BookMessageBus\UpdateBookMessage;
use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class UpdateBookMessageHandler
{

    public function __construct(
        private readonly BookRepository $bookRepository,
    ) {
    }


    /**
     * @throws \Exception
     */
    public function __invoke(UpdateBookMessage $updateBookMessage): void
    {
        try {
            $book = $this->bookRepository->find($updateBookMessage->getId());

            if (!$book) {
                throw new \Exception('Book not found');
            }

            $changedFields = $this->getChangedFields($updateBookMessage, $book);

            foreach ($changedFields as $field) {
                $setter = 'set' . ucfirst($field);
                $book->$setter($updateBookMessage->{'get' . ucfirst($field)}());
            }

            $this->bookRepository->save($book);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @throws \Exception
     */
    public function isFieldChanged(Book $book, string $fieldName, $currentValue): bool
    {
        $getter = 'get' . ucfirst($fieldName);
        if($fieldName === 'isPublic') {
            $getter = 'isPublic';
        }
        if (method_exists($book, $getter)) {
            return $book->$getter() !== $currentValue;
        }
        throw new \Exception("Getter for field $fieldName does not exist");
    }

    /**
     * @throws \Exception
     */
    public function getChangedFields(UpdateBookMessage $updateBookMessage, Book $book): array
    {
        $fields = ['title', 'publisher', 'pageCount', 'isPublic'];
        $changedFields = [];

        foreach ($fields as $field) {
            if ($this->isFieldChanged($book, $field, $updateBookMessage->{'get' . ucfirst($field)}())) {
                $changedFields[] = $field;
            }
        }

        return $changedFields;
    }


}