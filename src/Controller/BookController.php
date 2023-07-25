<?php

namespace App\Controller;

use App\Entity\Author;
use App\Message\BookMessageBus\AddBookMessage;
use App\Message\BookMessageBus\DeleteBookMessage;
use App\Message\BookMessageBus\UpdateBookMessage;
use App\Repository\AuthorRepository;
use App\Service\BookService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{


    public function __construct(
        private readonly MessageBusInterface $messageBus,
        private readonly BookService $bookService,
    ) {
    }


    #[Route('/api/add-book', name: 'add-book', methods: ['POST'])]
    public function addBook(Request $request): Response
    {
        try {
            $json = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);


            $this->messageBus->dispatch(
                new AddBookMessage(
                    $json['title'],
                    $json['publisher'],
                    $json['pageCount'],
                    $json['isPublic'],
                    $json['authors']


                )
            );
        } catch (\JsonException|\Exception $e) {
            return new Response($e->getMessage(), 400);
        }

        return $this->json([
            'message' => 'Book added successfully',
        ]);
    }

    #[Route('/api/delete-book', name: 'delete-book', methods: ['DELETE'])]
    public function deleteBook(Request $request): Response
    {
        try {
            $json = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

            if (!isset($json['id'])) {
                throw new \Exception('Id is required');
            }

            $this->messageBus->dispatch(
                new DeleteBookMessage(
                    $json['id']
                )
            );
        } catch (\JsonException|\Exception $e) {
            return new Response($e->getMessage(), 400);
        }

        return $this->json([
            'message' => 'Book deleted successfully',
        ]);
    }

    #[Route('/api/get-books', name: 'get-books', methods: ['GET'])]
    public function getBooks(): Response
    {
        try {
            $books = $this->bookService->getAllBooks();
        } catch (\Exception $e) {
            return new Response($e->getMessage(), 400);
        }

        return $this->json([
            'message' => 'Books fetched successfully',
            'data' => $books,
        ]);
    }


    #[Route('/api/update-book', name: 'update-book', methods: ['PATCH'])]
    public function updateBook(Request $request): Response
    {
        try {
            $json = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
            $this->messageBus->dispatch(
                new UpdateBookMessage(
                    $json['id'],
                    $json['title'],
                    $json['publisher'],
                    $json['pageCount'],
                    $json['isPublic']
                )
            );
        } catch (\JsonException|\Exception $e) {
            return new Response($e->getMessage(), 400);
        }

        return $this->json([
            'message' => 'Book updated successfully',
        ]);
    }


}