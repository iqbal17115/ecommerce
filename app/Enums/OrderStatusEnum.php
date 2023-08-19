<?php

namespace App\Enums;


class OrderStatusEnum
{

    public const PENDING = "pending";
    public const PROCESSING = "processing";
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
}
