<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nom'),
            DateTimeField::new('created_at')->hideOnForm(),
            DateTimeField::new('updated_at')->hideOnForm(),
            DateTimeField::new('published_at')->hideOnForm(),
        ];
    }
    // J'overide le persistEntity
    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if(!$entityInstance instanceof Category) return;

        $entityInstance->setCreatedAt(new \DateTimeImmutable());
        $entityInstance->setUpdatedAt(new \DateTimeImmutable());
        $entityInstance->setPublishedAt(new \DateTimeImmutable());

        // Pour flusher
        parent::persistEntity($em, $entityInstance);
        // $em->persist($entityInstance);
        // $em->flush();
    }
    public function deleteEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if(!$entityInstance instanceof Category) return;
        foreach($entityInstance->getServices() as $services)
        {
            $em->remove($services);
        }
        parent::deleteEntity($em, $entityInstance);
    }
}
