<?php
namespace App\Enums;

class PaymentStatusEnum
{
    public const PENDING = 'pending';
    public const AUTHORIZED = 'authorized';
    public const PAID = 'paid';
    public const FAILED = 'failed';
    public const REFUNDED = 'refunded';
    public const CHARGEBACK = 'chargeback';
    public const CANCELLED = 'cancelled';
    public const ON_HOLD = 'on_hold';
    public const EXPIRED = 'expired';
    public const PARTIALLY_PAID = 'partially_paid';
    public const PROCESSING = 'processing';
    public const WAITING_FOR_CONFIRMATION = 'waiting_for_confirmation';
    public const PENDING_SETTLEMENT = 'pending_settlement';
    public const COMPLETE = 'complete';

    public static function getValues()
    {
        return [
            self::PENDING => 'pending',
            self::AUTHORIZED => 'authorized',
            self::PAID => 'paid',
            self::FAILED => 'failed',
            self::REFUNDED => 'refunded',
            self::CHARGEBACK => 'chargeback',
            self::CANCELLED => 'cancelled',
            self::ON_HOLD => 'on_hold',
            self::EXPIRED => 'expired',
            self::PARTIALLY_PAID => 'partially_paid',
            self::PROCESSING => 'processing',
            self::WAITING_FOR_CONFIRMATION => 'waiting_for_confirmation',
            self::PENDING_SETTLEMENT => 'pending_settlement',
            self::COMPLETE => 'complete',
        ];
    }
}
