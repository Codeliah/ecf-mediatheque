<?php

namespace App\DataFixtures;

use App\Entity\book;
use App\Entity\Author;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');


        for ($i = 1; $i <= 50; $i++) {
            $book = [];
            $book = new book();
            $book->setTitle($faker->word(5));
            $book->setCover('https://picsum.photos/150/150');
            $book->setPublicationDate($faker->dateTimeThisCentury());
            $book->setDescription($faker->paragraph(2, false));
            $book->setAuthor($faker->firstname() . ' ' . $faker->lastname());
            $book->setIsbn($faker->isbn13());
            $book->setGenre($faker->word(8));
            

            $manager->persist($book);
            $books[] = $book;
        }


        $manager->flush();
    }
}
