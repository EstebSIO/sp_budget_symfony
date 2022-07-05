<?php

namespace App\EventSubscriber;

use App\Model\TimeStampInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AdminBudgetSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        // TODO: Implement getSubscribedEvents() method.
        return [
            BeforeEntityPersistedEvent::class => ['setEntityCreatedAt'],
            BeforeEntityUpdatedEvent::class => ['setEntityUpdatedAt']
        ];
    }

    public function setEntityCreatedAt(BeforeEntityPersistedEvent $entityPersistedEvent){
        $entity = $entityPersistedEvent->getEntityInstance();
        if(!$entity instanceof TimeStampInterface){return ;}
        $entity->setTransactionDateCreation(new \DateTime());
        $entity->setTransactionDateModif(new \DateTime());

    }
    public function setEntityUpdatedAt(BeforeEntityUpdatedEvent $entityPersistedEvent){
        $entity = $entityPersistedEvent->getEntityInstance();
        if(!$entity instanceof TimeStampInterface){return ;}
        $entity->setTransactionDateModif(new \DateTime());


    }
}