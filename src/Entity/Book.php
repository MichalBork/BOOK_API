<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Book
{
    #[ORM\Id, ORM\GeneratedValue, ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'string', length: 255)]
    private $publisher;

    #[ORM\Column(type: 'integer')]
    private $pageCount;

    #[ORM\Column(type: 'boolean')]
    private $isPublic;

    #[ORM\ManyToMany(targetEntity: Author::class)]
    private $authors;


    public function __construct(
        string $title,
        string $publisher,
        int $pageCount,
        bool $isPublic,
    ) {
        $this->title = $title;
        $this->publisher = $publisher;
        $this->pageCount = $pageCount;
        $this->isPublic = $isPublic;
        $this->authors = new ArrayCollection();
    }

    public function addAuthor(Author $author): void
    {
        if (!$this->authors->contains($author)) {
            $this->authors->add($author);
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getPublisher(): string
    {
        return $this->publisher;
    }

    /**
     * @return int
     */
    public function getPageCount(): int
    {
        return $this->pageCount;
    }

    /**
     * @return bool
     */
    public function isPublic(): bool
    {
        return $this->isPublic;
    }

    /**
     * @return Collection
     */
    public function getAuthors(): Collection
    {
        return $this->authors;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @param string $publisher
     */
    public function setPublisher(string $publisher): void
    {
        $this->publisher = $publisher;
    }

    /**
     * @param int $pageCount
     */
    public function setPageCount(int $pageCount): void
    {
        $this->pageCount = $pageCount;
    }

    /**
     * @param bool $isPublic
     */
    public function setIsPublic(bool $isPublic): void
    {
        $this->isPublic = $isPublic;
    }

    /**
     * @param ArrayCollection $authors
     */
    public function setAuthors(ArrayCollection $authors): void
    {
        $this->authors = $authors;
    }







}
