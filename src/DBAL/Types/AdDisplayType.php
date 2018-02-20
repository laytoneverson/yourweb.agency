<?php

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

class AdDisplayType extends AbstractEnumType
{
    const SQUARE_250X250 = "SQUARE";
    const SQUARE_SMALL_200X200 = "SQUARESMALL";
    const BANNER_468X60 = "BANNER";
    const LEADERBOARD_728X90 = "LEADERBOARD";
    const MOBILE_LEADERBOARD_320X50 = "MOBILELEADERBOARD";
    const INLINE_RECTANGLE_300X250  = "INLINERECTANGLE";
    const LARGE_RECTANGLE_336X280  = "LARGERECTANGLE";
    const SKYSCRAPER_120X600 = "SKYSCRAPER";
    const WIDE_SKYSCRAPER_160X600 = "WIDESKYSCRAPER";
    const HALF_PAGE_300X600 = "HALFPAGE";
    const LARGE_LEADERBOARD = "LARGELEADERBOARD";
    const FACEBOOK_AD_600X315 = "FACEBOOKAD";
    const FACEBOOK_COVER_851X315 = "FACEBOOKCOVER";
    const FACEBOOK_POST_940X788 = "FACEBOOKPOST";
    const POPUNDER = "POPUNDER";


    protected static $choices = [
        self::SQUARE_250X250    => 'Square',
        self::SQUARE_SMALL_200X200 => 'Small Square',
        self::BANNER_468X60 => 'Banner',
        self::LEADERBOARD_728X90 => 'Leader Board',
        self::MOBILE_LEADERBOARD_320X50 => 'Mobile Leader Board',
        self::INLINE_RECTANGLE_300X250  => 'Inline Rectangle',
        self::LARGE_RECTANGLE_336X280  => 'Large Rectangle',
        self::SKYSCRAPER_120X600 => 'Sky Scraper',
        self::WIDE_SKYSCRAPER_160X600 => 'Wide Sky Scraper',
        self::HALF_PAGE_300X600 => 'Half Page Ad',
        self::LARGE_LEADERBOARD => 'Large Leaderboard',
        self::FACEBOOK_AD_600X315 => 'Facebook Ad',
        self::FACEBOOK_COVER_851X315 => 'Facebook Cover',
        self::FACEBOOK_POST_940X788 => 'Facebook Post',
        self::POPUNDER => 'Pop-under',
    ];
}
