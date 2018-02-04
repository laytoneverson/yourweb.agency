<?php

namespace App\Repository;

use App\Entity\WebsiteCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Query\Expr;

class WebsiteCategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WebsiteCategory::class);
    }

    public function findCategoryWithSitesBySlug($slug, $status = null)
    {
        $qb =  $this->createQueryBuilder('c')
            ->select('c, w')
            ->where('c.categorySlug = :slug')->setParameter('slug', $slug);

        if ($status) {
            $qb->join('c.websites', 'w', Expr\Join::WITH, 'w.websiteStatus = :status');
        } else {
            $qb->join('c.websites', 'w');
        }

        return $qb
            ->getQuery()
            ->getOneOrNullResult();
    }
    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('w')
            ->where('w.something = :value')->setParameter('value', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
