<?php

namespace App\EventSubscriber;

use App\Entity\Blog;
use App\Entity\User;
use App\Entity\Diplome;
use App\Entity\Gallery;
use App\Entity\Product;
use App\Entity\Articles;
use App\Entity\Category;
use App\Entity\Services;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;

class AdminSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setCreatedAt'],
            BeforeEntityUpdatedEvent::class => ['setUpdatedAt']
        ];
    }

    public function setCreatedAt(BeforeEntityPersistedEvent $event)
    {
        $entityInstance = $event->getEntityInstance();
        if($entityInstance instanceof User && 
            !$entityInstance instanceof Articles && 
            !$entityInstance instanceof Blog && 
            !$entityInstance instanceof Category && 
            !$entityInstance instanceof Diplome && 
            !$entityInstance instanceof Gallery && 
            !$entityInstance instanceof Services)
        {
            return;
        }
        
    }

    public function setUpdatedAt(BeforeEntityUpdatedEvent $event)
    {
        $entityInstance = $event->getEntityInstance();
        if($entityInstance instanceof User && 
            !$entityInstance instanceof Articles && 
            !$entityInstance instanceof Blog && 
            !$entityInstance instanceof Category && 
            !$entityInstance instanceof Diplome && 
            !$entityInstance instanceof Gallery && 
            !$entityInstance instanceof Services)
        {
            return;
        }
        $entityInstance->setUpdatedAt(new \DateTimeImmutable());
    }
}