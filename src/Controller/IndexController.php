<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/')]
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }

    #[Route('/test')]
    public function test(): Response
    {
        return $this->render('test.html.twig');
    }

    #[Route('/pizza')]
    public function pizza(): Response
    {
        return $this->render('pizza.html.twig');
    }
}