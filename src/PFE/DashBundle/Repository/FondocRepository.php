<?php

namespace PFE\DashBundle\Repository;

use Doctrine\ORM\EntityRepository;

use PFE\DashBundle\Entity\Bibliotheque;

class FondocRepository extends EntityRepository
{
    public function findByDate(&$year = null, &$month = null)
    {
        if ($month === null) { $month = (int) date('m'); }
        if ($year === null) { $year = (int) date('Y'); }
        $date = new \DateTime("{$year}-{$month}-01");

        $qb = $this->createQueryBuilder('e');
        $qb->where('e.created BETWEEN :start AND :end')
            ->setParameter('start', $date->format('Y-m-d'))
            ->setParameter('end', $date->format('Y-m-t'))
        ;

        return $qb->getQuery()->getResult();
    }

     public function count($ism, Bibliotheque $b,&$year = null, &$month = null)
    {
        if ($month === null) { $month = (int) date('m'); }
        if ($year === null) { $year = (int) date('Y'); }
        $date = new \DateTime("{$year}-{$month}-01");
        $qb = $this->createQueryBuilder('f')
            ->leftJoin('f.typefondoc','tf')
            ->select('sum(f.nombre)')
            ->leftJoin('f.bibliotheque','b')
            ->where('b=:b')
            ->andWhere('tf.isMultimedia=:ism')
            ->andWhere('f.created BETWEEN :start AND :end')
            ->setParameter('start', $date->format('Y-m-d'))
            ->setParameter('end', $date->format('Y-m-t'))
            ->setParameter(':b',$b)
            ->setParameter(':ism',$ism)
            ->orderBy('tf.nom','ASC')
        ;
        return $qb->getQuery()->getSingleScalarResult();
    }

    public function findByBibDate(Bibliotheque $b ,&$year = null, &$month = null)
    {
        if ($month === null) { $month = (int) date('m'); }
        if ($year === null) { $year = (int) date('Y'); }
        $date = new \DateTime("{$year}-{$month}-01");

        $qb = $this->createQueryBuilder('e');
        $qb->where('e.created BETWEEN :start AND :end')
            ->andWhere('e.bibliotheque=:b')
            ->setParameter('start', $date->format('Y-m-d'))
            ->setParameter('end', $date->format('Y-m-t'))
            ->setParameter(':b',$b)
        ;

        return $qb->getQuery()->getResult();
    }

}
