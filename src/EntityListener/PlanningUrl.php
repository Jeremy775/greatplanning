<?php 

namespace App\EntityListener;

use App\Entity\Cda;
use Doctrine\ORM\Mapping\PostPersist;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class PlanningUrl
{
    /** @PostPersist */
    public function postPersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!$entity instanceof Cda) {
            return;
        }

        $entityManager = $args->getObjectManager();
        $entity->setUrl('cda/'.$entity->getId());
    }
}