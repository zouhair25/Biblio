<?php

namespace PFE\DashBundle\Entity;

use Doctrine\ORM\EntityRepository;

class AnimationRepository extends EntityRepository
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

    public function sumPublic(Typeanimation $ta, Bibliotheque $b, $column, &$year = null, &$month = null)
    {
        if ($month === null) { $month = (int) date('m'); }
        if ($year === null) { $year = (int) date('Y'); }
        $date = new \DateTime("{$year}-{$month}-01");

        $qb = $this->createQueryBuilder('a')
            ->select('sum(a.'.$column.')')
            ->leftJoin('a.typeanimation','ta')
            ->leftJoin('a.bibliotheque','b')

            ->where('b=:b')
            ->andWhere('ta=:ta')
            ->andWhere('a.created BETWEEN :start AND :end')
            ->setParameter('start', $date->format('Y-m-d'))
            ->setParameter('end', $date->format('Y-m-t'))
            ->setParameter(':ta',$ta)
            ->setParameter(':b',$b)
        ;

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function findByBibDate(Bibliotheque $b,$typeanimation=null, &$year = null, &$month = null)
    {
        if ($month === null) { $month = (int) date('m'); }
        if ($year === null) { $year = (int) date('Y'); }
        $date = new \DateTime("{$year}-{$month}-01");

        $qb = $this->createQueryBuilder('e');
        $qb->where('e.created BETWEEN :start AND :end')
            ->andWhere('e.bibliotheque=:b')
            ->andWhere('e.typeanimation=:typeanimation')
            ->setParameter('start', $date->format('Y-m-d'))
            ->setParameter('end', $date->format('Y-m-t'))
            ->setParameter(':b',$b)
            ->setParameter(':typeanimation',$typeanimation)
        ;


        return $qb->getQuery()->getResult();
    }
}
