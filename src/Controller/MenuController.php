<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MenuController extends AbstractController
{
    public function index(CategoryRepository $categoryRepository): Response
    {
        $cat = $categoryRepository->levelZero();
        
        // dd($cat[1]->getCategories()->getValues()[1]->getCategories()->getValues());
        

        // dump($categoryRepository->findAll());
        return $this->render('_partials/navbar.html.twig', [
            'categories' => $cat,
        ]);
            
        
    }
}
