<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InternatController extends AbstractController
{
    #[Route('/internat', name: 'app_internat')]
    public function index(): Response
    {
        return $this->render('internat/index.html.twig', [
            'controller_name' => 'InternatController',
        ]);
    }
}
