<?php

namespace App\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

class FileFormatType extends AbstractEnumType
{
    const TYPE_IMG_JPEG = 'jpeg';
    const TYPE_IMG_PNG = 'png';
    const TYPE_IMG_GIF = 'gif';
    const TYPE_IMG_SVG = '3wsvg+xml';
    const TYPE_APP_PDF = 'pdf';


    protected static $choices = [
        self::TYPE_IMG_JPEG  => 'image/jpeg' ,
        self::TYPE_IMG_PNG  => 'image/png' ,
        self::TYPE_IMG_GIF  => 'image/gif' ,
        self::TYPE_IMG_SVG  => 'image/svg+xml' ,
        self::TYPE_APP_PDF  => 'application/pdf' ,
    ];
}
