<?php

namespace App\DataFixtures;

use App\Entity\SocialSite;
use App\Entity\WebsiteCategory;
use Doctrine\Common\Persistence\ObjectManager;

class SocialSiteFixture extends AbstractUpdateableFixture
{
    protected function getFixtureData()
    {
        return [
            [
                "id" => 1,
                "siteName" => 'Project Home Page',
                "siteIconUrl" => '',
                "siteUrl" => '',
                "profileUrlStub" => '',
            ],[
                "id" => 2,
                "siteName" => 'Twitter',
                "siteIconUrl" => '',
                "siteUrl" => '',
                "profileUrlStub" => '',
            ],[
                "id" => 3,
                "siteName" => 'Facebook',
                "siteIconUrl" => '',
                "siteUrl" => '',
                "profileUrlStub" => '',
            ],[
                "id" => 4,
                "siteName" => 'Github',
                "siteIconUrl" => '',
                "siteUrl" => '',
                "profileUrlStub" => '',
            ],[
                "id" => 5,
                "siteName" => 'LinkedIn',
                "siteIconUrl" => '',
                "siteUrl" => '',
                "profileUrlStub" => '',
            ],[
                "id" => 6,
                "siteName" => 'Reddit',
                "siteIconUrl" => '',
                "siteUrl" => '',
                "profileUrlStub" => '',
            ],[
                "id" => 7,
                "siteName" => 'CryptoCompare',
                "siteIconUrl" => '',
                "siteUrl" => '',
                "profileUrlStub" => '',
            ],
        ];
    }

    protected function getEntityFqn()
    {
        return SocialSite::class;
    }

    public function load(ObjectManager $manager)
    {
        parent::load($manager);
    }

    public function getDeleteAbsentEntities()
    {
        return true;
    }
}
