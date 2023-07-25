<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Author
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $countryOrigin;

    #[ORM\ManyToMany(targetEntity: Book::class, mappedBy: 'authors')]
    private $books;


    public static function toArray(Author $author): array
    {
        return [
            'id' => $author->getId(),
            'name' => $author->getName(),
            'countryOrigin' => $author->getCountryOrigin(),
        ];
    }

    public function __construct(
        string $name,
        string $countryOrigin,
    ) {
        $this->name = $name;
        $this->countryOrigin = $countryOrigin;
    }


    /**
     * @return mixed
     */
    public function getId(): mixed
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName(): mixed
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getCountryOrigin(): mixed
    {
        return $this->countryOrigin;
    }

    /**
     * @return mixed
     */
    public function getBooks(): mixed
    {
        return $this->books;
    }


}
