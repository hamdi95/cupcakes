<?php

namespace CupCakesBundle\Repository;
use Doctrine\ORM\EntityRepository;

/**
 * CommandeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommandeRepository extends EntityRepository
{
    public function findMax()
    {
        $query = $this->createQueryBuilder('e')
            ->select('e')
            ->orderBy('e.id', 'DESC')
            ->setMaxResults(1)
;
        return $query->getQuery()->getOneOrNullResult();

    }
    public function rechercheId($user){
        $query = $this->createQueryBuilder('c')
            ->select('c')
            ->from('CupCakesBundle:LineCmd','lc')
            ->from('CupCakesBundle:Produit','p')
            ->andWhere('lc.idCmd = c.id')
            ->andWhere('lc.idProd = p.id')
            ->andWhere('p.idUser = :user' )
            ->andWhere('c.etatCmd = \'vrai\'')
            ->setParameter(':user',$user);
        return $query->getQuery()->getResult();

    }

    public function findUsername($username)
    {
        $q=$this->createQueryBuilder('m')
            ->from('CupCakesBundle:User','u')
            ->where('u.nom LIKE :username')
            ->andWhere('m.idUser=u.id')
            ->setParameter(':username',"%$username%");
        return $q->getQuery()->getResult();
    }


}
