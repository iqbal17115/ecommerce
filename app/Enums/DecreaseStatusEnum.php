<?php

namespace App\Enums;

class DecreaseStatusEnum
{
    public const FAILED = "failed";
    public const CANCELLED = "cancelled";
    public const RETURNED = "returned";
    public const REFUNDED = "refunded";
    public const PRE_ORDER = "pre_order";
    public const BACKORDERED = "backordered";
    public const PARTIALLY_SHIPPED = "partially_shipped";

    public static function DECREASE_STATUSES()
    {
        return [
            self::FAILED,
            self::CANCELLED,
            self::RETURNED,
            self::REFUNDED,
            self::PRE_ORDER,
            self::BACKORDERED,
            self::PARTIALLY_SHIPPED,
        ];
    }
}
