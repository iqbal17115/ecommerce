<?php

namespace App\Enums;

class PropertyTypeEnum
{
    public const HOUSE = "house";
    public const APARTMENT = "apartment";
    public const BUSINESS = "business";
    public const OTHER = "other";

    public static function getPropertyTypes()
    {
        return [
            self::HOUSE => 'House',
            self::APARTMENT => 'Apartment',
            self::BUSINESS => 'Business',
            self::OTHER => 'Other',
        ];
    }
}
