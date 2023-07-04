<?php

namespace App\Enums;

use App\Traits\BaseEnum;

class OrderStatusEnum
{
    use BaseEnum;

    public const PENDING = "pending";
    public const PROCESSING = "processing";
    public const SHIPPED = "shipped";
    public const ARRIVAL_AT_DISTRIBUTION_CENTER = "arrival_at_distribution_center";
    public const DELIVERED = "delivered";
    public const DELIVERY_ATTEMPTED = "delivery_attempted";
    public const DELIVERY_RESCHEDULING = "delivery_rescheduling";
    public const CANCELLED = "cancelled";
    public const RETURNED = "returned";
    public const REFUNDED = "refunded";
    public const HOLD = "hold";
    public const BACKORDERED = "backordered";
    public const PARTIALLY_SHIPPED = "partially_shipped";
    public const FAILED = "failed";
    public const OUT_FOR_DELIVERY = "out_for_delivery";
    public const PRE_ORDER = "pre_order";
}
