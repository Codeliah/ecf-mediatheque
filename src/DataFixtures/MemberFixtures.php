<?php

namespace App\DataFixtures;

use App\Entity\Member;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Validator\Constraints\Date;

class MemberFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager):void
    {
        //Utilisation de Faker
        $faker = Factory::create(('fr_FR'));
        $faker->seed(1234);

        //Création d'un utilisateur
        for ($i = 0; $i <= 20; $i++) {
            $member = [];
            $member = new Member();
            $member->setEmailAddress($faker->email());
            $member->setFirstName($faker->firstName());
            $member->setLastName($faker->lastName());
            $member->setbirthDate($faker->dateTime($format ='d-m-Y'));
            $member->setPostalAddress($faker->address());

            $password = $this->encoder->encodePassword($member, 'password');
            $member->setPassword($password);

            $manager->persist($member);
        }

        
        $manager->flush();
    }
}
