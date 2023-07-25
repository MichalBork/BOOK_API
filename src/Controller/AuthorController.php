<?php

namespace App\Controller;

use App\Message\BookMessageBus\AddAuthorToBookMessage;
use App\Service\AuthorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{


    public function __construct(
        private readonly AuthorService $authorService,
        private readonly MessageBusInterface $messageBus,

    ) {
    }


    #[Route('/api/find-author-books', name: 'find-author-books', methods: ['GET'])]
    public function findAuthorBooks(Request $request): Response
    {
        try {
            $books = $this->authorService->findAuthorBookByName($request->query->get('name'));
        } catch (\InvalidArgumentException $e) {
            return new Response($e->getMessage(), 400);
        }

        return $this->json([
            'books' => $books,
        ]);
    }


    #[Route('/api/add-author-books', name: 'find-author-books', methods: ['PATCH'])]
    public function addAuthorBooks(Request $request): Response
    {
        try {
            $json = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

            foreach ($json['authors'] as $author) {
                $this->messageBus->dispatch(
                    new AddAuthorToBookMessage(
                        $json['book'],
                        $author,

                    )
                );
            }
        } catch (\Throwable $e) {
            return new Response($e->getMessage(), 400);
        }

        return $this->json([
            'message' => 'Books added successfully',
        ]);
    }
}