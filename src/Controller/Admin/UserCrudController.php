<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }
    public function configureCrud(Crud $crud) :Crud
    {
        return $crud
            ->setEntityLabelInPlural('Liste des utilisateurs')
            ->setEntityLabelInSingular('un utilisateur')
            ->setDefaultSort(['id' => 'ASC'])
            ->setPaginatorPageSize(5);
    }
   
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnIndex()->hideOnForm(),
            EmailField::new('Email'),
            TextField::new('lastname', 'Nom'),
            TextField::new('firstname', 'Prénom'),   
            TextField::new('password', 'Mot de passe')->setFormType(PasswordType::class)->hideOnIndex(),
            BooleanField::new('isVerified')->onlyOnIndex(),
        ];
    }
    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if(!$entityInstance instanceof User) return;

        $entityInstance->setCreatedAt(new \DateTimeImmutable());
        $entityInstance->setUpdatedAt(new \DateTimeImmutable());
        // Pour flusher
        parent::persistEntity($em, $entityInstance);
        // $em->persist($entityInstance);
        // $em->flush();
    }
}
