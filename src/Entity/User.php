<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class User
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $username;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $token;


    public function __construct(string $username, string $token,)
    {
        $this->username = $username;
        $this->token = $token;
    }

}
