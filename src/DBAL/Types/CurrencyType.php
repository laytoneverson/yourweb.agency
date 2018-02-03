<?php

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

class CurrencyType extends AbstractEnumType
{
    protected $name = 'CurrencyType';

    const FIAT   = 'Fiat';
    const COIN   = 'crypto';
    const TOKEN  = 'token';
    const RAREMETAL  = 'RareMetal';

    protected static $choices = [
        self::FIAT    => 'Fiat',
        self::COIN => 'CryptoCurrency',
        self::TOKEN  => 'CryptoToken',
        self::RAREMETAL  => 'Rare Metal',
    ];
}
