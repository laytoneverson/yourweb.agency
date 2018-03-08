<?php
/**
 * Author: Layton Everson <layton.everson@gmail.com>
 * YourWeb Solutions
 * User: layto
 * Date: 3/6/2018
 * Time: 8:30 PM
 */

namespace App\Service;


use App\Entity\OutboundLinkClick;
use App\Entity\OutboundLinkUrl;
use App\Entity\OutLink;
use App\Entity\Website;
use Doctrine\ORM\EntityManagerInterface;
use function is_int;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use function urlencode;

class OutboundLinkService
{
    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * OutboundLinkService constructor.
     *
     * @param RequestStack $requestStack
     * @param EntityManagerInterface $em
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        RequestStack $requestStack,
        EntityManagerInterface $em,
        UrlGeneratorInterface $urlGenerator
    )    {
        $this->requestStack = $requestStack;
        $this->em = $em;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * Called from controller, handles an outbound service directory link
     *
     * @param $outboundLinkUrlId
     * @return OutboundLinkUrl
     * @throws \Exception
     */
    public function handleExitClick($outboundLinkUrlId): OutboundLinkUrl
    {
        /** @var OutboundLinkUrl $outboundLinkUrl */

        $request = $this->requestStack->getMasterRequest();
        $outboundLinkUrl = $this->em->getRepository(OutboundLinkUrl::class)
            ->find($outboundLinkUrlId);

        if (!$outboundLinkUrl) {
            throw new \Exception("Unable to locate outbound link entity");
        }

        if ($request) {
            $ip = $request->getClientIp();
            $ref = $request->headers->get('referer');
        } else {
            $ip = 'Unknown';
            $ref = 'Unknown';
        }

        $outboundLinkUrl->visit();
        $exitClick = new OutboundLinkClick($outboundLinkUrl, $ip, $ref);
        $this->em->persist($exitClick);
        $this->em->flush();

        return $outboundLinkUrl;
    }

    /**
     * @param $url
     * @return string
     */
    public function exitLinkByUrl($url)
    {
        $exitLinkUrl  = $this->getExitUrlEntity($url);

        return $this->urlGenerator->generate('exit_link', [
            'outboundLinkUrlId' => $exitLinkUrl->getId(),
        ], UrlGeneratorInterface::ABSOLUTE_URL);
    }

    /**
     * @param $siteId
     * @return string
     */
    public function serviceDirectorySiteLink($website)
    {
        $exitLinkUrl = $this->getExitUrlEntity(null, $website);

        return $this->urlGenerator->generate('exit_link', [
            'outboundLinkUrlId' => $exitLinkUrl->getId(),
        ], UrlGeneratorInterface::ABSOLUTE_URL);
    }

    /**
     * Finds or creates a new OutboundLinkUrl entity using a Website entity
     *
     * @param $website Website|int
     * @return OutboundLinkUrl
     */
    private function getExitUrlEntity($websiteUrl = null, $website = null): OutboundLinkUrl
    {
        if ($website) {
            if (is_int($website)) {
                $website = $this->em->getReference(Website::class, $website);
            }

            $linkUrl = $this->em->getRepository(OutboundLinkUrl::class)
                ->findOneBy([
                    'website' => $website
                ]);
            $websiteUrl = $website->getWebsiteUrl();
        } else {
            $linkUrl = $this->em
                ->getRepository(OutboundLinkUrl::class)
                ->findOneByUrl($websiteUrl);
        }

        if (null === $linkUrl) {
            $linkUrl = (null !== $website)
                ? new OutboundLinkUrl($website)
                : new OutboundLinkUrl($websiteUrl);

            $this->em->persist($linkUrl);
            $this->em->flush();
        }

        return $linkUrl;
    }

}
