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

    public function findCategoriesAndSites()
    {
        $qb = $this->createQueryBuilder('c')
            ->select('c, w')
            ->leftJoin('c.websites', 'w');

        return $qb->getQuery()->getResult();
    }

    public function findCategoryWithSitesBySlug($slug, $status = null)
    {
        $qb =  $this->createQueryBuilder('c')
            ->select('c, w')
            ->where('c.categorySlug = :slug')->setParameter('slug', $slug);

        if ($status) {
            $qb->leftJoin('c.websites', 'w', Expr\Join::WITH, 'w.websiteStatus = :status');
        } else {
            $qb->leftJoin('c.websites', 'w');
        }

        $qb->orderBy('w.websiteStatus', "ASC");

        return $qb
            ->getQuery()
            ->getOneOrNullResult();
    }
}
