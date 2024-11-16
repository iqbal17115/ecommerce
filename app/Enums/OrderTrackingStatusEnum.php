<?php
namespace App\Enums;

class OrderTrackingStatusEnum
{
    public const PENDING = 'pending';
    public const PROCESSING = 'processing';
    public const SHIPPED = 'shipped';
    public const DELIVERED = 'delivered';

    public static function getOrderTrackingStatus()
    {
        return [
            self::PENDING => 'pending',
            self::PROCESSING => 'processing',
            self::SHIPPED => 'shipped',
            self::DELIVERED => 'delivered',
        ];
    }
}
