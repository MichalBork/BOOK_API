<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;

class UserService
{


    public function __construct(
        private readonly UserRepository $userRepository,
    ) {
    }

    public function findUserByToken(string $token): ?User
    {
        return $this->userRepository->findOneBy(['token' => $token]);
    }
}