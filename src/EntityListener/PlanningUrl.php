<?php 

namespace App\EntityListener;

use App\Entity\Cda;
use Doctrine\ORM\Mapping\PostPersist;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class PlanningUrl
{
    /** @PostPersist */
    public function postPersist(Cda $cda, LifecycleEventArgs $args)
    {
        dd($cda, $args);
        $cda->setUrl('cda/'.$cda->getId());
    }

    // public function postUpdate(LifecycleEventArgs $args)
    // {
    //     dd($args);
    //     $this->defaultUrl($args);
    // }

    // public function defaultUrl(LifecycleEventArgs $args)
    // {
    //     $entity = $args->getObject();
    //     $cda_id = $entity->getId();
    //     dump($cda_id);
    //     if(!$entity instanceof Cda)
    //     {
    //         return;
    //     }

    //     $entity->setUrl('dsdf');

    // }

}