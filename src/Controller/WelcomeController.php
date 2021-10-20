<?php

namespace App\Controller;

use App\Repository\WelcomeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class WelcomeController extends AbstractController
{
    #[Route('/home', name: 'homepage')]
    public function index(Environment $twig, WelcomeRepository $welcomeRepository): Response
    {
        return new Response($twig->render('base.html.twig', [
            'welcome' => $welcomeRepository->findAll(),
        ]));
    }
}
