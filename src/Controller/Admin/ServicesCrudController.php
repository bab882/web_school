<?php

namespace App\Controller\Admin;

use DateTimeImmutable;
use App\Entity\Services;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class ServicesCrudController extends AbstractCrudController
{
    public const ACTION_DUPLICATE = 'duplicate';
    public const SERVICES_BASE_PATH = 'assets/img/services';
    public const SERVICES_UPLOAD_DIR = 'public/assets/img/services';
    

    public static function getEntityFqcn(): string
    {
        return Services::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        $duplicate = Action::new(self::ACTION_DUPLICATE)
            ->linkToCrudAction('duplicateServices')
            ->setCssClass('btn btn-info');

        return $actions
        ->add(Crud::PAGE_EDIT, $duplicate)
        ->reorder(Crud::PAGE_EDIT, [self::ACTION_DUPLICATE, Action::SAVE_AND_RETURN]);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nom'),
            TextField::new('title', 'Titre'),
            TextField::new('slug', 'Url'),
            ImageField::new('img', 'Images')
                ->setBasePath(self::SERVICES_BASE_PATH)
                ->setUploadDir(self::SERVICES_UPLOAD_DIR)
                ->setSortable(false),
            TextEditorField::new('description', 'Texte'),
            DateTimeField::new('created_at')->hideOnForm(),
            DateTimeField::new('updated_at')->hideOnForm(),
            DateTimeField::new('published_at')->hideOnForm(),
        ];
    }

    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if(!$entityInstance instanceof Services) return;

        $entityInstance->setCreatedAt(new \DateTimeImmutable());
        $entityInstance->setUpdatedAt(new \DateTimeImmutable());
        $entityInstance->setPublishedAt(new \DateTimeImmutable());

        // Pour flusher
        parent::persistEntity($em, $entityInstance);
    }

    public function duplicateServices(AdminContext $context, AdminUrlGenerator $adminUrlGenerator, EntityManagerInterface $em) :Response
    {
        /** @var Services $services */
        $services = $context->getEntity()->getInstance();

        $duplicatedServices = clone $services;

        parent::persistEntity($em, $duplicatedServices);

        // Pour générer un Url et rediriger 
        $url = $adminUrlGenerator
            ->setController(self::class)
            ->setAction(Action::DETAIL)
            ->setEntityId($duplicatedServices->getId())
            ->generateUrl();

        return $this->redirect($url);
    }
}
