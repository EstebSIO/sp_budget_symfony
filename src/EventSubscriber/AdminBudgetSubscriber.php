<?php

namespace App\EventSubscriber;

use App\Entity\Admin;
use App\Entity\Transactions;
use App\Model\TimeStampInterface;
use App\Model\PassWordHashAdmin;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

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
        if(!$entity instanceof PassWordHashAdmin){return ;}
        if($entity instanceof Admin){
            $this->_setRoles($entity);
            $passwordHash = new UserPasswordHasher();

            $hashedPassword = $passwordHash->hashPassword(
                $entity,
                $entity->getPassword()
            );        $entity->setRoles([$entity->getRole()->getNomRole()]);
            $entity->setPassword($hashedPassword);

        }
        if($entity instanceof Transactions){
            $entity->setTransactionDateCreation(new \DateTime());
            $entity->setTransactionDateModif(new \DateTime());
        }


    }
    public function setEntityUpdatedAt(BeforeEntityUpdatedEvent $entityPersistedEvent){
        $entity = $entityPersistedEvent->getEntityInstance();
        if(!$entity instanceof TimeStampInterface){return ;}
        $entity->setTransactionDateModif(new \DateTime());


    }
    public function _setRoles(Admin $entity){


    }
}