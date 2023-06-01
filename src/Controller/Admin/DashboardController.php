<?php

namespace App\Controller\Admin;

use App\Entity\Articles;
use App\Entity\Blog;
use App\Entity\Category;
use App\Entity\Gallery;
use App\Entity\Services;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
        
    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // Je vais gerer un url depuis adminUrlGenerator
        $url = $this->adminUrlGenerator
            ->setController(UserCrudController::class)
            ->generateUrl();
        
        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Web_school');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::subMenu('Actualités', 'fas fa-newspaper text-primary');
        yield MenuItem::subMenu('Articles', 'fas fa-bars' )->setSubItems([
            MenuItem::linkToCrud('Liste', 'fas fa-eye', Articles::class),
            MenuItem::linkToCrud('Créer', 'fas fa-plus', Articles::class)->setAction(Crud::PAGE_NEW)   
        ]);
        yield MenuItem::subMenu('Blog', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Liste', 'fas fa-eye', Blog::class),
            MenuItem::linkToCrud('Créer', 'fas fa-plus', Blog::class)->setAction(Crud::PAGE_NEW)   
        ]);
        yield MenuItem::subMenu('Catégories', 'fas fa-folder text-primary')->setSubItems([
            MenuItem::linkToCrud('Liste', 'fas fa-eye', Category::class),
            MenuItem::linkToCrud('Créer', 'fas fa-plus', Category::class)->setAction(Crud::PAGE_NEW)
            
        ]);

        yield MenuItem::subMenu('Formations', 'fas fa-graduation-cap text-primary')->setSubItems([
            MenuItem::linkToCrud('Liste', 'fas fa-eye', Services::class),
            MenuItem::linkToCrud('Créer', 'fas fa-plus', Services::class)->setAction(Crud::PAGE_NEW)  
        ]);
        yield MenuItem::subMenu('Galerie', 'fas fa-images text-primary')->setSubItems([
            MenuItem::linkToCrud('Liste', 'fas fa-eye', Gallery::class),
            MenuItem::linkToCrud('Créer', 'fas fa-plus', Gallery::class)->setAction(Crud::PAGE_NEW)  
        ]);
        yield MenuItem::subMenu('Utilisateurs', 'fas fa-user text-primary')->setSubItems([
            MenuItem::linkToCrud('Liste', 'fas fa-eye', User::class),
            MenuItem::linkToCrud('Créer', 'fas fa-plus', User::class)->setAction(Crud::PAGE_NEW)   
        ]);
        
        
        
        

        // yield MenuItem::
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
