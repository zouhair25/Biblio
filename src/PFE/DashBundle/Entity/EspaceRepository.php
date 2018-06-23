<?php

namespace PFE\DashBundle\Entity;

use Doctrine\ORM\EntityRepository;

class EspaceRepository extends EntityRepository
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



    public function findByBibDate(Bibliotheque $b, &$year = null, &$month = null)
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

    public function counto($column, $value, Bibliotheque $b, &$year = null, &$month = null)
    {
        if ($month === null) { $month = (int) date('m'); }
        if ($year === null) { $year = (int) date('Y'); }
        $date = new \DateTime("{$year}-{$month}-01");

        $qb = $this->createQueryBuilder('e')
            ->select('count(e.id)')
            ->where('e.'.$column.'=:value')
            ->andWhere('e.bibliotheque=:b')
            ->andWhere('e.created BETWEEN :start AND :end')
            ->setParameter(':value',$value)
            ->setParameter(':b',$b)
            ->setParameter('start', $date->format('Y-m-d'))
            ->setParameter('end', $date->format('Y-m-t'))
        ;

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function countplaces(Bibliotheque $b,&$year = null, &$month = null)
    {
        if ($month === null) { $month = (int) date('m'); }
        if ($year === null) { $year = (int) date('Y'); }
        $date = new \DateTime("{$year}-{$month}-01");


        $qb = $this->createQueryBuilder('e')
            ->select('sum(e.nombrePlaceAssises)')
            ->where('e.bibliotheque=:value')
            ->setParameter(':value',$b)
            ->andWhere('e.created BETWEEN :start AND :end')
            ->setParameter('start', $date->format('Y-m-d'))
            ->setParameter('end', $date->format('Y-m-t'))
        ;

        return $qb->getQuery()->getSingleScalarResult();
    }
}
