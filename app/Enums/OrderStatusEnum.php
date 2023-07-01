<?php

namespace App\Enums;

use App\Traits\BaseEnum;

enum OrderStatusEnum: string
{
    use BaseEnum;

    case PENDING = "pending";
    case PROCESSING = "processing";
    case SHIPPED = "shipped";
    case DELIVERED = "delivered";
    case CANCELLED = "cancelled";
    case REFUNDED = "refunded";
    case HOLD = "hold";
    case BACKORDERED = "backordered";
    case PARTIALLY_SHIPPED = "partially_shipped";
    case FAILED = "failed";
    case OUT_FOR_dELIVERY = "out_for_delivery";
    case PRE_ORDER = "pre_order";
}
