<?php

namespace App\Enums;

class ProductReturnReasonEnum
{
    public const UNDELIVERABLE = 'undeliverable';
    public const PRICING_ERROR = 'pricing_error';
    public const OUT_OF_STOCK = 'out_of_stock';
    public const UNAVAILABILITY = 'unavailability';
    public const FRAUD_PREVENTION = 'fraud_prevention';
    public const DUPLICATE_ORDER = 'duplicate_order';

    public static function getReasons()
    {
        return [
            self::UNDELIVERABLE => 'Shipping Address Undeliverable',
            self::PRICING_ERROR => 'Pricing Error',
            self::OUT_OF_STOCK => 'Out Of Stock',
            self::UNAVAILABILITY => 'Unavailability',
            self::FRAUD_PREVENTION => 'Fraud Prevention',
            self::DUPLICATE_ORDER => 'Duplicate Order',
        ];
    }
}
?>
