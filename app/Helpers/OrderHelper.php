<?php

namespace App\Helpers;

use App\Enums\OrderStatusEnum;

class OrderHelper
{
    /**
     * Get the badge class based on the order status.
     */
    public static function getOrderStatusBadge(string $status): string
    {
        return match ($status) {
            OrderStatusEnum::PENDING => 'badge-warning',       // 🟠 Pending
            OrderStatusEnum::PROCESSING => 'badge-primary',    // 🔵 Processing
            OrderStatusEnum::SHIPPED => 'badge-info',          // 🟦 Shipped
            OrderStatusEnum::DELIVERED => 'badge-success',     // ✅ Delivered
            OrderStatusEnum::COMPLETED => 'badge-success',     // ✅ Completed
            OrderStatusEnum::HOLD => 'badge-secondary',        // ⚪ Hold
            OrderStatusEnum::FAILED => 'badge-danger',         // ❌ Failed
            OrderStatusEnum::CANCELLED => 'badge-dark',        // ⚫ Cancelled
            default => 'badge-light',                          // Default
        };
    }

    /**
     * Get the human-readable status name.
     */
    public static function getOrderStatusName(string $status): string
    {
        return OrderStatusEnum::getOrderStatuses()[$status] ?? ucwords($status);
    }
}
