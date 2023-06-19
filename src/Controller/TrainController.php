<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrainController extends AbstractController
{
    #[Route('/train', name: 'app_train')]
    public function index(): Response
    {
        return $this->render('train/index.html.twig', [
            'controller_name' => 'TrainController',
        ]);
    }
}
