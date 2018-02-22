<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AppUserRepository")
 */
class AppUser
{
    use TimeStampableTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AppUser", mappedBy="ratings")
     * @var Collection
     */
    private $ratings;

    /**
     * @param Rating $rating
     */
    public function addRating(Rating $rating)
    {
        $this->ratings->add($rating);
        $rating->setAppUser($this);
    }

    /**
     * @param Rating $rating
     */
    public function removeRating(Rating $rating)
    {
        $this->ratings->removeElement($rating);
        $rating->setAppUser(null);
    }
}
