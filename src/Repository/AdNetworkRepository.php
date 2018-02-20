<?php

namespace App\Repository;

use App\Entity\AdNetwork;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class AdNetworkRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AdNetwork::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('a')
            ->where('a.something = :value')->setParameter('value', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
