<?php

namespace App\Repository;

use App\DBAL\Types\ReviewSiteStatusType;
use App\Entity\Website;
use App\Entity\WebsiteCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Query\Expr;

class WebsiteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Website::class);
    }

    public function findSitesNeedingCaptured()
    {
        return $this->createQueryBuilder('w')
            ->where('w.websiteImageUrl = \'\'')
            ->orWhere('w.websiteImageUrl IS NULL')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $slug
     * @return Collection
     */
    public function findSitesInCategoryBySlug($slug)
    {
        $qb = $this->createQueryBuilder('s')
            ->select('s, c')
            ->join(
                WebsiteCategory::class,
                "c",
                Expr\Join::WITH,
                "c.categorySlug = :slug"
            )->setParameter("slug", $slug);

        return $qb->getQuery()->getResult();
    }

    public function getRecentAdditions($resultCount = 10)
    {
        $qb = $this->createQueryBuilder('s')
//            ->join(WebsiteCategory::class,"c")
            ->where('s.websiteStatus = :goodStanding')
            ->setParameter('goodStanding', ReviewSiteStatusType::GOOD_STANDING)
            ->setMaxResults($resultCount);

        return $qb->getQuery()->getResult();
    }

    public function findOneBySlug($slug)
    {

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
