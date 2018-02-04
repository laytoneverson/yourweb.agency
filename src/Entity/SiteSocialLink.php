<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SiteSocialLinkRepository")
 */
class SiteSocialLink
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SocialSite", inversedBy="socialLinks")
     * @var SocialSite
     */
    private $socialSite;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return SocialSite
     */
    public function getSocialSite(): SocialSite
    {
        return $this->socialSite;
    }

    /**
     * @param SocialSite $socialSite
     */
    public function setSocialSite(SocialSite $socialSite): void
    {
        $this->socialSite = $socialSite;
    }
}
