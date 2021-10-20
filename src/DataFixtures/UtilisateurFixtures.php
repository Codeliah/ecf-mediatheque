<?php

namespace App\DataFixtures;

use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;


class UtilisateurFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager):void
    {
        $utilisateur = new Utilisateur();
        $utilisateur->setEmail("admin@test.com");
        $utilisateur->setRoles(["ROLE_ADMIN"]);
        $utilisateur->setPassword($this->encoder->encodePassword($utilisateur, "root123"));
        $manager->persist($utilisateur);
        $manager->flush();
    }
}
