<?php

namespace App\Enums;


class ShippingZoneTypeEnum
{

    public const INSIDE_OUTSIDE = "inside_outside";
    public const LOCATION = "location";
    public const MIXED = "mixed";

    public static function getShippingZoneTypes()
    {
        return [
            self::INSIDE_OUTSIDE => 'Inside/Outside',
            self::LOCATION => 'Location',
            self::MIXED => 'Mixed',
        ];
    }
}
