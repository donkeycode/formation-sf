<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Book;
use App\Entity\Author;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $author = new Author();
        $author->setName('Victor Hugo');
        $manager->persist($author);

        $book = new Book();
        $book->setTitle('Les misérables');
        $book->setAuthor($author);
        $manager->persist($book);

        $manager->flush();
    }
}
