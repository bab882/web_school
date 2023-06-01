<?php

namespace App\Controller\Admin;

use App\Entity\Articles;
use App\Entity\Services;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\HttpFoundation\Response;

class ArticlesCrudController extends AbstractCrudController
{
    
        public const ACTION_DUPLICATE = 'duplicate';
        public const ARTICLES_BASE_PATH = 'assets/img/articles';
        public const ARTICLES_UPLOAD_DIR = 'public/assets/img/articles';
        
        public static function getEntityFqcn(): string
        {
            return Articles::class;
        }

    public function configureActions(Actions $actions): Actions
    {
        $duplicate = Action::new(self::ACTION_DUPLICATE)
            ->linkToCrudAction('duplicateArticles')
            ->setCssClass('btn btn-info');

        return $actions
        ->add(Crud::PAGE_EDIT, $duplicate)
        ->reorder(Crud::PAGE_EDIT, [self::ACTION_DUPLICATE, Action::SAVE_AND_RETURN]);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title', 'Titre'),
            TextField::new('small_description'),
            TextEditorField::new('description', 'Texte'),
            ImageField::new('img', 'Images')
                ->setBasePath(self::ARTICLES_BASE_PATH)
                ->setUploadDir(self::ARTICLES_UPLOAD_DIR)
                ->setSortable(false),
            TextField::new('slug', 'Url'),
            DateTimeField::new('created_at')->hideOnForm(),
            DateTimeField::new('updated_at')->hideOnForm(),
            DateTimeField::new('published_at')->hideOnForm(),
        ];
    }

    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if(!$entityInstance instanceof Articles) return;

        $entityInstance->setCreatedAt(new \DateTimeImmutable());
        $entityInstance->setUpdatedAt(new \DateTimeImmutable());
        $entityInstance->setPublishedAt(new \DateTimeImmutable());

        // Pour flusher
        parent::persistEntity($em, $entityInstance);
    }

    public function duplicateArticles(AdminContext $context, AdminUrlGenerator $adminUrlGenerator, EntityManagerInterface $em) :Response
    {
        /** @var Articles $articles */
        $articles = $context->getEntity()->getInstance();

        $duplicatedArticles = clone $articles;

        parent::persistEntity($em, $duplicatedArticles);

        // Pour générer un Url et rediriger 
        $url = $adminUrlGenerator
            ->setController(self::class)
            ->setAction(Action::DETAIL)
            ->setEntityId($duplicatedArticles->getId())
            ->generateUrl();

        return $this->redirect($url);
    }
}
