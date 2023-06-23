<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MenuController extends AbstractController
{
    public function index(CategoryRepository $categoryRepository): Response
    {

        $tabMenu = [];

        $leval0 =  $categoryRepository->levelZero();
        foreach ( $leval0 as $items0 ) {
            $tabMenu[] = [
                'name' => $items0->getName()
                // 'slug' => $items0->getSlug();
            ];
                


            $leval1 =  $categoryRepository->levelun($items0);
            foreach ($leval1 as $items1) {
            $leval2 =  $categoryRepository->leveldeux($items1);
                foreach ($leval2 as $items2) {
                    echo $items2;
                }
            }
        }

        dd($tabMenu);
        // dump($categoryRepository->findAll());
        return $this->render('_partials/navbar.html.twig', [
            
        ]);
            
        
    }
}
