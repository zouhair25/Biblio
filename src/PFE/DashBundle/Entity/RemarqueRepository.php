<?php

namespace PFE\DashBundle\Entity;

use Doctrine\ORM\EntityRepository;

class RemarqueRepository extends EntityRepository
{
    public function findByDate(&$year = null, &$month = null)
    {
        if ($month === null) {
            $month = (int)date('m');
        }
        if ($year === null) {
            $year = (int)date('Y');
        }
        $date = new \DateTime("{$year}-{$month}-01");

        $qb = $this->createQueryBuilder('e');
        $qb->where('e.created BETWEEN :start AND :end')
            ->setParameter('start', $date->format('Y-m-d'))
            ->setParameter('end', $date->format('Y-m-t'));

        return $qb->getQuery()->getResult();
    }

    public function findByBibDate(Bibliotheque $b,$type='remarque' ,&$year = null, &$month = null)
    {
        if ($month === null) { $month = (int) date('m'); }
        if ($year === null) { $year = (int) date('Y'); }
        $date = new \DateTime("{$year}-{$month}-01");

        $qb = $this->createQueryBuilder('e');
        $qb->where('e.created BETWEEN :start AND :end')
            ->andWhere('e.bibliotheque=:b')
            ->andWhere('e.type=:type')
            ->setParameter('start', $date->format('Y-m-d'))
            ->setParameter('end', $date->format('Y-m-t'))
            ->setParameter(':b',$b)
            ->setParameter(':type',$type)
        ;


        return $qb->getQuery()->getResult();
    }
}