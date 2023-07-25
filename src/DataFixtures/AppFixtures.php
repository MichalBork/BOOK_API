<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User(
            'admin',
            '123'

        );

        $manager->persist($user);


        $author = new Author(
            'J.K. Rowling',
            'United Kingdom'
        );

        $author2 = new Author(
            'J.R.R. Tolkien',
            'United Kingdom'
        );

        $author3 = new Author(
            'George R.R. Martin',
            'United States'
        );

        $author4 = new Author(
            'Stephen King',
            'United States'
        );

        $manager->persist($author);
        $manager->persist($author2);
        $manager->persist($author3);
        $manager->persist($author4);

        $book = new Book(
            'Harry Potter and the Philosopher\'s Stone',
            'Nowa Era',
            '1997',
            'true',

        );

        $book->addAuthor($author);

        $manager->persist($book);

        $manager->flush();
    }
}
