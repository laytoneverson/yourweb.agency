<?php

namespace App\DataFixtures;

use App\Entity\WebsiteStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SiteStatus extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /**
         * @var WebsiteStatus $existingStatus
         */
        $currentStatuses = $manager->getRepository(WebsiteStatus::class)
            ->findAll();

        foreach (['Online', 'Error Loading', 'Offline', 'Scam Alert!']as $Status) {
            $workingStatus = null;
            foreach($currentStatuses as $existingStatus) {
                if ($existingStatus->getStatusName() == $Status) {
                    $workingStatus = $existingStatus;
                }
            }
            if (null === $workingStatus) {
                $workingStatus = new WebsiteStatus();
                $manager->persist($workingStatus);
            }
            $workingStatus->setStatusName($Status);
        }

        $manager->flush();
    }
}
