<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use App\Repository\ServicesRepository;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('main/index.html.twig', [
            'categories' => $categoryRepository->findBy([], ['name' => 'ASC']),
            
        ]);
    }
}
