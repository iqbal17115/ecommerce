<?php

namespace App\Enums;

use App\Traits\BaseEnum;

class OrderStatusEnum
{
    use BaseEnum;

    public const PENDING = "pending";
    public const PROCESSING = "processing";
    public const SHIPPED = "shipped";
    public const DELIVERED = "delivered";
    public const CANCELLED = "cancelled";
    public const REFUNDED = "refunded";
    public const HOLD = "hold";
    public const BACKORDERED = "backordered";
    public const PARTIALLY_SHIPPED = "partially_shipped";
    public const FAILED = "failed";
    public const OUT_FOR_DELIVERY = "out_for_delivery";
    public const PRE_ORDER = "pre_order";
}
