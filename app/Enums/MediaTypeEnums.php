<?php

namespace App\Enums;

class MediaTypeEnums
{
    public const PHOTO = 'photo';
    public const DOCUMENT = 'document';
    public const GALLERY = 'gallery';

    public static function getValues()
    {
        // Define media type
        return [
            self::PHOTO => 'photo',
            self::DOCUMENT => 'document',
            self::GALLERY => 'gallery'
        ];
    }
}
