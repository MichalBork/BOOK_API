<?php

namespace App\EventSubscriber;

use App\Service\UserService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class AuthTokenSubscriber implements EventSubscriberInterface
{

    public function __construct(
        private readonly UserService $userService,
    )
    {
    }

    public static function getSubscribedEvents(): array
    {
        // return the subscribed events, their methods and priorities
        return [
            KernelEvents::REQUEST => 'onKernelRequest',
        ];
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();

        $authToken = $request->headers->get('authToken');

       $user = $this->userService->findUserByToken($authToken);
        if (!$user) {
            // No authToken header, return a 401 response
            $response = new Response('Unauthorized', 401);
            $event->setResponse($response);
        }

        // Here you can check if authToken is valid. If not, you can return a 403 response
        // $response = new Response('Forbidden', 403);
        // $event->setResponse($response);
    }

}