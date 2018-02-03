<?php

namespace App\DataFixtures;

use App\Entity\WebsiteCategory;
use Doctrine\Common\Persistence\ObjectManager;

class SiteCategoryFixture extends AbstractUpdateableFixture
{
    protected function getFixtureData()
    {
        return  [
            [
                "id" => 1,
                "CategoryName" => 'Coin Faucets',
                "CategorySummary" => 'Free coins through faucets.',
            ],[
                "id" => 2,
                "CategoryName" => 'Buy Coins',
                "CategorySummary" => 'Places to exchange coins for fiat currency or credit cards.',
            ],[
                "id" => 3,
                "CategoryName" => 'Trading Exchanges',
                "CategorySummary" => 'Recommended currency exchange sites.',
            ],[
                "id" => 4,
                "CategoryName" => 'Wallets',
                "CategorySummary" => 'Best places and tools to store your coins.',
            ],
            [
                "id" => 5,
                "CategoryName" => 'High Yield Investments',
                "CategorySummary" => 'Best places to put your skills to work for coins.',
            ],
            [
                "id" => 6,
                "CategoryName" => 'Coin Market Data',
                "CategorySummary" => 'Best sites to track coin values',
            ],
            [
                "id" => 7,
                "CategoryName" => 'Mining Pools',
                "CategorySummary" => 'Best contract mining companies',
            ],
            [
                "id" => 8,
                "CategoryName" => 'Instant Exchanges',
                "CategorySummary" => 'Instantly exchange coins for other coins or cash',
            ],
            [
                "id" => 9,
                "CategoryName" => 'Advertising Networks',
                "CategorySummary" => 'Coin related advertising networks.',
            ],
            [
                "id" => 10,
                "CategoryName" => 'Gaming Sites',
                "CategorySummary" => 'Have fun with your coins. Earn and spend fye.',
            ],
            [
                "id" => 11,
                "CategoryName" => 'Casinos and Betting',
                "CategorySummary" => 'Bringing vegas to your living room with top casino and gambline sites.',
            ],
        ];
    }

    protected function getEntityFqn()
    {
        return WebsiteCategory::class;
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
