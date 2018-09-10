<?php

namespace App\Repository;

use App\Entity\HomeForm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class HomeFormRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, HomeForm::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('m')
            ->where('m.something = :value')->setParameter('value', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function count($images)
    {
    $qb = $this->createQueryBuilder('u');
    return $qb
        ->select('count(u.id)')
        ->getQuery()
        ->getSingleScalarResult();
    }
}
