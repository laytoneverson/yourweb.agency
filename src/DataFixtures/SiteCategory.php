<?php

namespace App\DataFixtures;

use App\Entity\WebsiteCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SiteCategory extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /**
         * @var WebsiteCategory $existingCategory
         */
        $currentCategories = $manager->getRepository(WebsiteCategory::class)
            ->findAll();

        foreach ($this->getData() as $category) {
            $workingCategory = null;
            foreach($currentCategories as $existingCategory) {
                if ($existingCategory->getCategoryName() == $category['label']) {
                    $workingCategory = $existingCategory;
                }
            }
            if (null === $workingCategory) {
                $workingCategory = new WebsiteCategory();
                $manager->persist($workingCategory);
            }
            $workingCategory->setCategoryName($category['label'])
                ->setCategorySummary($category['summary']);
        }

        $manager->flush();
    }

    private function getData()
    {
        return [
            [
                "label" => 'Free Coin Faucets',
                "summary" => 'Free coins through faucets.',
            ],[
                "label" => 'Purchase Coins With Cash Or Credit',
                "summary" => 'Places to exchange coins for fiat currency or credit cards.',
            ],[
                "label" => 'Currency Exchanges',
                "summary" => 'Recommended currency exchange sites.',
            ],[
                "label" => 'Recommended Wallets',
                "summary" => 'Best places and tools to store your coins.',
            ],


            [
                "label" => 'High Yield Investment Programs',
                "summary" => 'Best places to put your skills to work for coins.',
            ],

            [
                "label" => 'Coin Market Information',
                "summary" => 'Best sites to track coin values',
            ],
            [
                "label" => 'Best Investment Sites',
                "summary" => 'Best & Worst places to invest your coins.',
            ],
            [
                "label" => 'Best Mining Services',
                "summary" => 'Best contract mining companies',
            ],
            [
                "label" => 'Instant Exchanges',
                "summary" => 'Instantly exchange coins for other coins or cash',
            ],
            [
                "label" => 'Advertising Networks',
                "summary" => 'Coin related advertising networks.',
            ],
            [
                "label" => 'Gaming Sites',
                "summary" => 'Have fun with your coins. Earn and spend fye.',
            ],
            [
                "label" => 'Casinos and Betting',
                "summary" => 'Bringing vegas to your living room with top casino and gambline sites.',
            ],
        ];
    }
}
