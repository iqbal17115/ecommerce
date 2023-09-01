<?php
namespace App\Enums;

class PaymentTypeEnum
{
    public const CREDIT_CARD = 'creditCard';
    public const DEBIT_CARD = 'debitCard';
    public const PAYPAL = 'paypal';
    public const BANK_TRANSFER = 'bankTransfer';
    public const GOOGLE_PAY = 'googlePay';
    public const APPLE_PAY = 'applePay';
    public const VENMO = 'venmo';
    public const BITCOIN = 'bitcoin';
    public const CASH = 'cash';
    public const CHECK = 'check';
    public const MONEY_ORDER = 'moneyOrder';
    public const WIRE_TRANSFER = 'wireTransfer';
    public const GIFT_CARD = 'giftCard';
    public const OTHER = 'other';

    public static function getPaymentTypes()
    {
        return [
            self::CREDIT_CARD => 'Credit Card',
            self::DEBIT_CARD => 'Debit Card',
            self::PAYPAL => 'PayPal',
            self::BANK_TRANSFER => 'Bank Transfer',
            self::GOOGLE_PAY => 'Google Pay',
            self::APPLE_PAY => 'Apple Pay',
            self::VENMO => 'Venmo',
            self::BITCOIN => 'Bitcoin',
            self::CASH => 'Cash',
            self::CHECK => 'Check',
            self::MONEY_ORDER => 'Money Order',
            self::WIRE_TRANSFER => 'Wire Transfer',
            self::GIFT_CARD => 'Gift Card',
            self::OTHER => 'Other',
        ];
    }
}
