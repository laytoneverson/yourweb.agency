<?php

namespace App\DataFixtures;

use App\Entity\WebsiteCategory;
use const CUBRID_AUTOCOMMIT_FALSE;
use Doctrine\Common\Persistence\ObjectManager;

class SiteCategoryFixture extends AbstractUpdateableFixture
{
    protected function getFixtureData()
    {
        return  [
            [
                "id" => 1,
                "CategoryName" => 'Coin Faucets',
                "CategorySummary" => 'Earn Free cryptocurrency through the best coin faucets on the web.',
            ],[
                "id" => 2,
                "CategoryName" => 'Buy / Sell Coins',
                "CategorySummary" => 'Purchase or sell cryptocurrency using cash or credit cards.',
            ],[
                "id" => 3,
                "CategoryName" => 'Currency Trade Exchanges',
                "CategorySummary" => 'Trade your way to the top with currency exchanges.',
            ],[
                "id" => 4,
                "CategoryName" => 'Wallets',
                "CategorySummary" => 'Best places and tools to store your coins.',
            ],
            [
                "id" => 5,
                "CategoryName" => 'High Yield Investments',
                "CategorySummary" => 'Put your skills to work and get paid with cryptocurrency.',
            ],
            [
                "id" => 6,
                "CategoryName" => 'Coin Portfolio\'s and Market Data',
                "CategorySummary" => 'Research coin values and keep track of your portfolio',
            ],
            [
                "id" => 7,
                "CategoryName" => 'Mining Pools',
                "CategorySummary" => 'Find a trustworthy, high paying mining pool.',
            ],
            [
                "id" => 8,
                "CategoryName" => 'Instant Exchanges',
                "CategorySummary" => 'Quickly and conveniently exchange one cryptocoin for another.',
            ],
            [
                "id" => 9,
                "CategoryName" => 'Advertising Networks',
                "CategorySummary" => 'CryptoCurrency related advertising networks.',
            ],
            [
                "id" => 10,
                "CategoryName" => 'Gaming Sites',
                "CategorySummary" => 'Have fun with your coins and find a new addiction.',
            ],
            [
                "id" => 11,
                "CategoryName" => 'Casinos & Betting',
                "CategorySummary" => 'Bringing vegas to your living room! View the internets bitcoin casinos and betting sites.',
            ],
            [
                "id" => 12,
                "CategoryName" => 'Shop With CryptoCurrency',
                "CategorySummary" => 'Retailers and service providers that accept cryptocurrency.',
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
        return false;
    }
}
