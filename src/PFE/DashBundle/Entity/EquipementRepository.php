<?php

namespace PFE\DashBundle\Entity;

use Doctrine\ORM\EntityRepository;

class EquipementRepository extends EntityRepository
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

    public function getEquipementsByBibliotheque($ray, Bibliotheque $b, &$year = null, &$month = null)
    {
        if ($month === null) { $month = (int) date('m'); }
        if ($year === null) { $year = (int) date('Y'); }
        $date = new \DateTime("{$year}-{$month}-01");

        $qb = $this->createQueryBuilder('eq')
            ->leftJoin('eq.espace','e')
            ->leftJoin('eq.typeequipement','teq')
            ->addSelect('teq')
            ->leftJoin('e.bibliotheque','b')
            ->where('b=:b')
            ->andWhere('teq.isRayonnage=:ray')
            ->andWhere('eq.created BETWEEN :start AND :end')
            ->setParameter('start', $date->format('Y-m-d'))
            ->setParameter('end', $date->format('Y-m-t'))
            ->setParameter(':b',$b)
            ->setParameter(':ray',$ray)
            ->orderBy('teq.nom','ASC')
        ;

        return $qb->getQuery()->getArrayResult();
    }

    public function countetat($ray, $dispo, Bibliotheque $b, &$year = null, &$month = null)
    {
        if ($month === null) { $month = (int) date('m'); }
        if ($year === null) { $year = (int) date('Y'); }
        $date = new \DateTime("{$year}-{$month}-01");

        $qb = $this->createQueryBuilder('eq')
            ->select('count(eq.id)')
            ->leftJoin('eq.espace','e')
            ->leftJoin('eq.typeequipement','teq')
            ->leftJoin('e.bibliotheque','b')
            ->where('b=:b')
            ->andWhere('eq.isDisponible=:dispo')
            ->andWhere('teq.isRayonnage=:ray')
            ->andWhere('eq.created BETWEEN :start AND :end')
            ->setParameter('start', $date->format('Y-m-d'))
            ->setParameter('end', $date->format('Y-m-t'))
            ->setParameter(':dispo',$dispo)
            ->setParameter(':ray',$ray)
            ->setParameter(':b',$b)
        ;

        return $qb->getQuery()->getSingleScalarResult();
    }
}
