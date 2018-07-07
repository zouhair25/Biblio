<?php

namespace PFE\DashBundle\Entity;

use Doctrine\ORM\EntityRepository;
use PFE\UserBundle\Entity\User;

class BibliothequeRepository extends EntityRepository
{

   public function findWithMaj()
    {
        $qb = $this->createQueryBuilder('b');
        $qb
            ->addSelect('b')
            ->leftJoin('b.maj','mj')
            ->addSelect('mj')
        ;
        return $qb->getQuery()->getResult();
    }
    public function findWithMajRespo(User $respo)
    {
        $qb = $this->createQueryBuilder('b');
        $qb
            ->addSelect('b')
            ->leftJoin('b.maj','mj')
            ->addSelect('mj')
            ->leftJoin('b.responsable','respo')
            ->where('respo=:respo')
            ->setParameter(':respo', $respo)
        ;
        return $qb->getQuery()->getResult();
    }
}
