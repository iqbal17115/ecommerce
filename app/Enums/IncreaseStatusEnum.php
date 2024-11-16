<?php

namespace App\Enums;

class IncreaseStatusEnum
{
    public const PENDING = "pending";
    public const PROCESSING = "processing";
    public const WAITING_FOR_HANDOVER = "waiting_for_handover";
    public const SHIPPED = "shipped";
    public const IN_TRANSIT = "in_transit";
    public const ARRIVAL_AT_DISTRIBUTION_CENTER = "arrival_at_distribution_center";
    public const OUT_FOR_DELIVERY = "out_for_delivery";
    public const DELIVERY_ATTEMPTED = "delivery_attempted";
    public const DELIVERY_RESCHEDULING = "delivery_rescheduling";
    public const DELIVERED = "delivered";
    public const PAYMENT_COLLECTED = "payment_collected";
    public const COMPLETED = "completed";
    public const HOLD = "hold";

    public static function INCREASE_STATUSES()
    {
        return [
            self::PENDING,
            self::PROCESSING,
            self::SHIPPED,
            self::IN_TRANSIT,
            self::ARRIVAL_AT_DISTRIBUTION_CENTER,
            self::OUT_FOR_DELIVERY,
            self::DELIVERY_ATTEMPTED,
            self::DELIVERY_RESCHEDULING,
            self::DELIVERED,
            self::PAYMENT_COLLECTED,
            self::COMPLETED,
            self::HOLD
        ];
    }
}
