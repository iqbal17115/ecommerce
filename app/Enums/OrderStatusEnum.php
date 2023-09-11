<?php

namespace App\Enums;


class OrderStatusEnum
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
    public const FAILED = "failed";
    public const CANCELLED = "cancelled";
    public const RETURNED = "returned";
    public const REFUNDED = "refunded";
    public const PRE_ORDER = "pre_order";
    public const BACKORDERED = "backordered";
    public const PARTIALLY_SHIPPED = "partially_shipped";

    public static function getOrderStatuses()
    {
        return [
            self::PENDING => 'Pending',
            self::PROCESSING => 'Processing',
            self::SHIPPED => 'Shipped',
            self::IN_TRANSIT => 'In Transit',
            self::ARRIVAL_AT_DISTRIBUTION_CENTER => 'Arrival at Distribution Center',
            self::OUT_FOR_DELIVERY => 'Out for Delivery',
            self::DELIVERY_ATTEMPTED => 'Delivery Attempted',
            self::DELIVERY_RESCHEDULING => 'Delivery Rescheduling',
            self::DELIVERED => 'Delivered',
            self::PAYMENT_COLLECTED => 'Payment Collected',
            self::COMPLETED => 'Completed',
            self::HOLD => 'Hold',
            self::FAILED => 'Failed',
            self::CANCELLED => 'Cancelled',
            self::RETURNED => 'Returned',
            self::REFUNDED => 'Refunded',
            self::PRE_ORDER => 'Pre Order',
            self::BACKORDERED => 'Backordered',
            self::PARTIALLY_SHIPPED => 'Partially Shipped',
        ];
    }
}
