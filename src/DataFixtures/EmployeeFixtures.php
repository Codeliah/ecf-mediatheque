<?php

namespace App\DataFixtures;

use App\Entity\Employee;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class EmployeeFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        //Utilisation de Faker
        $faker = Factory::create(('fr_FR'));
        $faker->seed(1234);

        //Création d'un utilisateur
        for ($i = 0; $i <= 5; $i++) {
            $employee = [];
            $employee = new Employee();
            $employee->setEmailAddress($faker->email());
            $employee->setName($faker->name());
            $employee->setRoles(["ROLE_USER"]);
            $employee->setPassword($faker->password());
            $employee->setPassword($this->encoder->encodePassword($employee, 'password'));

            $manager->persist($employee);
        }

        $manager->flush();
    }
}
