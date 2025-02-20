<?php

namespace App\Enums;

class CouponScopeEnum
{
    public const ALL = 'all';
    public const SPECIFIC_PRODUCTS = 'specific_products';
    public const SPECIFIC_CATEGORIES = 'specific_categories';

    /**
     * Get all available scope options.
     *
     * @return array
     */
    public static function getScopeOptions()
    {
        return [
            self::ALL => 'Applicable to all',
            self::SPECIFIC_PRODUCTS => 'Specific products only',
            self::SPECIFIC_CATEGORIES => 'Specific categories only',
        ];
    }
}
