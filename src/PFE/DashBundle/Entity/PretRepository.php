<?php

namespace PFE\DashBundle\Entity;

use Doctrine\ORM\EntityRepository;

class PretRepository extends EntityRepository
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

    public function getPretByBibliotheque(Bibliotheque $b, &$year = null, &$month = null)
    {
        if ($month === null) { $month = (int) date('m'); }
        if ($year === null) { $year = (int) date('Y'); }
        $date = new \DateTime("{$year}-{$month}-01");

        $qb = $this->createQueryBuilder('p')
            ->leftJoin('p.fondoc','f')
            ->leftJoin('p.typepret','tp')
            ->leftJoin('f.bibliotheque','b')
            ->leftJoin('f.typefondoc','tf')
            ->addSelect('p')
            ->addSelect('f')
            ->addSelect('tf')
            ->addSelect('tp')
            ->where('b=:b')
            ->setParameter(':b',$b)
            ->orderBy('tf.nom','ASC')
            ->andwhere('p.created BETWEEN :start AND :end')
            ->setParameter('start', $date->format('Y-m-d'))
            ->setParameter('end', $date->format('Y-m-t'))
        ;

        return $qb->getQuery()->getArrayResult();
    }

    public function countdocs(Bibliotheque $b, $type='',$select='', &$year = null, &$month = null)
    {
        if ($month === null) { $month = (int) date('m'); }
        if ($year === null) { $year = (int) date('Y'); }
        $date = new \DateTime("{$year}-{$month}-01");

        $qb = $this->createQueryBuilder('p')
            ->leftJoin('p.fondoc','f')
            ->leftJoin('f.bibliotheque','b')
            ->where('b=:value')
            ->setParameter(':value',$b)
            ->andwhere('p.created BETWEEN :start AND :end')
            ->setParameter('start', $date->format('Y-m-d'))
            ->setParameter('end', $date->format('Y-m-t'))
        ;

        if($type!=''){
            $qb->leftJoin('p.typepret','tp')
                ->andWhere('tp.nom=:type')
                ->setParameter(':type',$type); }

        if($select=='pret') { $qb->select('count(p.id)');   }
        else                { $qb->select('sum(p.nombre)'); }

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function dkfjs(Bibliotheque $b, $type='')
    {
//        count doc
//        count pret
//        ==> group by fondoc
        // yes 3awtani pie
    }
}
