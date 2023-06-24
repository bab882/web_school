<?php

namespace App\Controller\Admin;

use App\Entity\Blog;
use App\Entity\User;
use App\Entity\Diplome;
use App\Entity\Gallery;
use App\Entity\Articles;
use App\Entity\Category;
use App\Entity\Services;
use App\Controller\Admin\UserCrudController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Core\User\UserInterface;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;


class DashboardController extends AbstractDashboardController
{
    private $adminUrlGenerator;

    public function __construct(AdminUrlGenerator $adminUrlGenerator)
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
            ->setTitle('Viviani - Administration')
            ->renderContentMaximized();         
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Actualités');
        yield MenuItem::subMenu('Articles', 'fas fa-star text-light d-flex jflex-row-reverse')->setSubItems([
            MenuItem::linkToCrud('Liste', 'fas fa-eye', Articles::class),
            MenuItem::linkToCrud('Créer', 'fas fa-plus', Articles::class)->setAction(Crud::PAGE_NEW)   
        ]);
        yield MenuItem::subMenu('Blog', 'fas fa-newspaper text-light')->setSubItems([
            MenuItem::linkToCrud('Liste', 'fas fa-eye', Blog::class)->setPermission('ROLE_ADMIN'),
            MenuItem::linkToCrud('Créer', 'fas fa-plus', Blog::class)->setAction(Crud::PAGE_NEW)->setPermission('ROLE_ADMIN')   
        ]);

        yield MenuItem::subMenu('Catégories', 'fas fa-folder text-primary')->setSubItems([
            MenuItem::linkToCrud('Liste', 'fas fa-eye', Category::class)->setPermission('ROLE_ADMIN'),
            MenuItem::linkToCrud('Créer', 'fas fa-plus', Category::class)->setAction(Crud::PAGE_NEW)->setPermission('ROLE_ADMIN')
            
        ]);

        yield MenuItem::subMenu('Formations', 'fas fa-book text-primary')->setSubItems([
            MenuItem::linkToCrud('Liste', 'fas fa-eye', Services::class)->setPermission('ROLE_ADMIN'),
            MenuItem::linkToCrud('Créer', 'fas fa-plus', Services::class)->setAction(Crud::PAGE_NEW)->setPermission('ROLE_ADMIN')  
        ]);
        yield MenuItem::subMenu('Galerie', 'fas fa-images text-primary')->setSubItems([
            MenuItem::linkToCrud('Liste', 'fas fa-eye', Gallery::class)->setPermission('ROLE_SUPER_ADMIN'),
            MenuItem::linkToCrud('Créer', 'fas fa-plus', Gallery::class)->setAction(Crud::PAGE_NEW)->setPermission('ROLE_ADMIN')  
        ]);
        yield MenuItem::subMenu('Utilisateurs', 'fas fa-user text-primary')->setSubItems([
            MenuItem::linkToCrud('Liste', 'fas fa-eye', User::class)->setPermission('ROLE_ADMIN'),
            MenuItem::linkToCrud('Créer', 'fas fa-plus', User::class)->setAction(Crud::PAGE_NEW)->setPermission('ROLE_ADMIN')   
        ]);
        yield MenuItem::subMenu('Diplomes', 'fas fa-graduation-cap text-primary')->setSubItems([
            MenuItem::linkToCrud('Liste', 'fas fa-eye', Diplome::class)->setPermission('ROLE_ADMIN'),
            MenuItem::linkToCrud('Créer', 'fas fa-plus', Diplome::class)->setAction(Crud::PAGE_NEW)->setPermission('ROLE_ADMIN')   
        ]);
        yield MenuItem::linkToRoute('Retour à l\'Accueil', 'fas fa-home', 'app_main');
    }    
}
