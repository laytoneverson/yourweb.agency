<?php

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

class ReviewSiteStatusType extends AbstractEnumType
{
    const GOOD_STANDING   = 1;
    const PENDING_VARIFICATION   = 2;
    const USE_CAUTION = 3;
    const OFFLINE_PERMINENT  = 4;
    const OFFLINE_TEMPORARY  = 5;
    const SCAM_ALERT = 6;

    protected static $choices = [
        self::GOOD_STANDING    => 'Good Standing',
        self::PENDING_VARIFICATION => 'Pending Verification',
        self::OFFLINE_TEMPORARY  => 'Offline - Temporary ',
        self::USE_CAUTION => 'Use Caution',
        self::OFFLINE_PERMINENT  => 'Offline - Indefinite',
        self::SCAM_ALERT  => 'CONFIRMED_SCAM',
    ];
}
