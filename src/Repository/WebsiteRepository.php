<?php

namespace App\Repository;

use App\DBAL\Types\ReviewSiteStatusType;
use App\Entity\Website;
use App\Entity\WebsiteCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use function is_numeric;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Query\Expr;

class WebsiteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Website::class);
    }

    public function findSiteBySlug($slug)
    {
        $qb = $this->createQueryBuilder('s')
            ->where('s.slug = :slug')
            ->setParameter('slug', $slug);
        return $qb->getQuery()->getOneOrNullResult();
    }

    public function findSitesNeedingCaptured($limitResults = null)
    {
        return $this->createQueryBuilder('w')
            ->where('w.snapshot IS NULL')
            ->setMaxResults($limitResults)
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
            ->where('s.websiteStatus IN (:statuses)')
            ->setParameter('statuses', [
                ReviewSiteStatusType::GOOD_STANDING,
                ReviewSiteStatusType::PENDING_VERIFICATION,
            ])
            ->orderBy('s.id', 'DESC')
            ->setMaxResults($resultCount);

        return $qb->getQuery()->getResult();
    }

    public function getFeaturedSites($resultCount = 10)
    {
        $qb = $this->createQueryBuilder('s')
            ->where('s.featured = TRUE')
            ->andWhere('s.websiteStatus IN (:statuses)')
            ->setParameter('statuses', [
                ReviewSiteStatusType::GOOD_STANDING,
                ReviewSiteStatusType::PENDING_VERIFICATION,
            ])
            ->setMaxResults($resultCount);

        return $qb->getQuery()->getResult();
    }
}
