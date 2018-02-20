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

    public function findSite($id, $lockMode = null, $lockVersion = null)
    {
        return $this->createQueryBuilder('s')
            ->where('s.id = :siteId')->setParameter('siteId', $id)
            ->join('s.websiteCategories', 'c')
            ->getQuery()
            ->getOneOrNullResult();
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
            ->where('s.websiteStatus IN (:statuses)')
            ->setParameter('statuses', [
                ReviewSiteStatusType::GOOD_STANDING,
                ReviewSiteStatusType::PENDING_VARIFICATION,
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
                ReviewSiteStatusType::PENDING_VARIFICATION,
            ])
            ->setMaxResults($resultCount);

        return $qb->getQuery()->getResult();
    }

    public function findOneBySlug($slug)
    {

    }
}
