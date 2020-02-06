<?php

namespace CupCakesBundle\Repository;

/**
 * FeedBackRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FeedBackRepository extends \Doctrine\ORM\EntityRepository
{
    public function findSujet($sujet)
    {
        $q=$this->createQueryBuilder('m')
            ->where('m.sujet LIKE :sujet')
            ->setParameter(':sujet',"%$sujet%");
        return $q->getQuery()->getResult();
    }
}