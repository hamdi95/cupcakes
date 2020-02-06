<?php

namespace CupCakesBundle\Repository;

/**
 * SessionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SessionRepository extends \Doctrine\ORM\EntityRepository
{
    public function rechercheDateSession($dateSess)
    {
        $q=$this->getEntityManager()->createQuery("select s from CupCakesBundle:Session s where 
           s.dateDebSes=:datedeb ")
            ->setParameter(':datedeb',$dateSess);
        return $q->getResult();

    }

    function compare_date($date1,$date2){

        return (strtotime($date1)-strtotime($date2)) ;

    }

    //requete sessions finies
    public function SessionEncours($iduser)
    {
        $etatSes ='en cours';
        $query = $this->createQueryBuilder('s')
            ->select('s')
            ->from('CupCakesBundle:Educate','e')
            ->Where('s.etatSes=:etatSes')
            ->andWhere('s.id=e.idSes' )
            ->andWhere('e.idUser=:iduser')
            ->setParameter(':iduser',$iduser)
            ->setParameter(':etatSes',$etatSes);

        return $query->getQuery()->getResult();
    }

    //requete des sessions en cours
    public function Sessionfinie($iduser)
    {
        $etatSes ='finie';
        $query = $this->createQueryBuilder('s')
            ->select('s')
            ->from('CupCakesBundle:Educate','e')
            ->Where('s.etatSes=:etatSes')
            ->andWhere('s.id=e.idSes' )
            ->andWhere('e.idUser=:iduser')
            ->setParameter(':iduser',$iduser)
            ->setParameter(':etatSes',$etatSes);

        return $query->getQuery()->getResult();

    }

    //requete pour les sessions dun formateur
    public function ListesessionsAffectes($id,$idFor)
    {
        $query = $this->createQueryBuilder('s')
            ->from('CupCakesBundle:Formation','f')
            ->Where('f.id=s.idFor')
            ->andWhere('f.idUser=:iduser')
            ->andWhere('s.idFor= :idFor')
            ->setParameter(':idFor',$idFor)
            ->setParameter(':iduser',$id);
        return $query->getQuery()->getResult();
    }


    //requete select des sessions par id user
    //et qui sont en etat en cours
    public function SelectSessionByidUser($iduser)
    {
        $etat="en cours";
        $query = $this->createQueryBuilder('s')
            ->from('CupCakesBundle:Formation','f')
            ->Where('f.id=s.idFor')
            ->andWhere('s.etatSes=:etat')
            ->andWhere('f.idUser=:iduser')
            ->setParameter(':iduser',$iduser)
            ->setParameter(':etat',$etat);
        return $query->getQuery()->getResult();
    }

    public function SelectSessionByidFor($id)
    {
        $etat="en cours";
        $query = $this->createQueryBuilder('s')
            ->Where('s.etatSes = :etat')
            ->andWhere('s.idFor=:idFor')
            ->setParameter(':idFor',$id)
            ->setParameter(':etat',$etat);
        return $query->getQuery()->getResult();
    }

    //requete select des sessions qui ont une promotion
    public function findSessionPromo()
    {
        $etat = 'en cours';
        $query = $this->createQueryBuilder('s')
            ->from('CupCakesBundle:LinePromoSes','lp')
            ->Where('s.id=lp.idSes')
            ->andWhere('lp.etatLinePromoSess=:etat')
            ->setParameter(':etat',$etat);

        return $query->getQuery()->getResult();
    }
}