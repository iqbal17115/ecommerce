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

    public static function getPaymentStatuses()
    {
        return [
            self::PENDING => 'Pending',
            self::AUTHORIZED => 'Authorized',
            self::PAID => 'Paid',
            self::FAILED => 'Failed',
            self::REFUNDED => 'Refunded',
            self::CHARGEBACK => 'Chargeback',
            self::CANCELLED => 'Cancelled',
            self::ON_HOLD => 'On-Hold',
            self::EXPIRED => 'Expired',
            self::PARTIALLY_PAID => 'Partially Paid',
            self::PROCESSING => 'Processing',
            self::WAITING_FOR_CONFIRMATION => 'Waiting for Confirmation',
            self::PENDING_SETTLEMENT => 'Pending Settlement',
            self::COMPLETE => 'Complete',
        ];
    }
}