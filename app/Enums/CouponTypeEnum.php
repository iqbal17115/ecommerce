<?php
namespace App\Enums;

class CouponTypeEnum
{
    public const PERCENT = 'percentage';
    public const FIXED_AMOUNT = 'fixed_amount';

    public static function getCouponTypeTypes()
    {
        return [
            self::PERCENT => 'percentage',
            self::FIXED_AMOUNT => 'fixed_amount'
        ];
    }
}
