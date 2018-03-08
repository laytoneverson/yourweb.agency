<?php

namespace App\Repository;

use App\Entity\OutboundLinkUrl;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use function parse_url;
use const PHP_URL_HOST;
use Symfony\Bridge\Doctrine\RegistryInterface;

class OutboundLinkUrlRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, OutboundLinkUrl::class);
    }

    /**
     * @param $url
     * @return OutboundLinkUrl|null
     */
    public function findOneByUrl($url):? OutboundLinkUrl
    {
        $host = parse_url($url, PHP_URL_HOST);
        $qb = $this->createQueryBuilder('u')
            ->where('u.host = :host')->setParameter('host', $host)
            ->andWhere('u.linkUrl =:url')->setParameter('url', $url);

        return $qb->getQuery()->getOneOrNullResult();
    }
}
