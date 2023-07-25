<?php

namespace App\MessageHandler;

use App\Entity\User;
use App\Message\AddUserMessage;
use App\Repository\UserRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class AddUserMessageHandler
{

    public function __construct(
        private readonly UserRepository $userRepository,
    ) {
    }


    /**
     * @throws \Exception
     */
    public function __invoke(AddUserMessage $message): void
    {
        try {
            $user = new User(
                $message->getUsername(),
                $message->getToken(),
            );

            $this->userRepository->save($user);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

}