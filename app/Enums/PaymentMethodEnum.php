<?php
namespace App\Enums;

class PaymentMethodEnum
{
    public const VISA = 'visa';
    public const MASTERCARD = 'mastercard';
    public const PAYPAL = 'paypal';
    public const BANK = 'bank';
    public const AMEX = 'amex';
    public const DISCOVER = 'discover';
    public const JCB = 'jcb';
    public const DINERS_CLUB = 'dinersclub';
    public const ALIPAY = 'alipay';
    public const WECHAT_PAY = 'wechatpay';
    public const CASH_APP = 'cashapp';
    public const VENMO = 'venmo';

    public static function getPaymentMethods()
    {
        return [
            self::VISA => 'Visa',
            self::MASTERCARD => 'MasterCard',
            self::PAYPAL => 'PayPal',
            self::BANK => 'Bank Transfer',
            self::AMEX => 'American Express',
            self::DISCOVER => 'Discover',
            self::JCB => 'JCB',
            self::DINERS_CLUB => "Diner's Club",
            self::ALIPAY => 'Alipay',
            self::WECHAT_PAY => 'WeChat Pay',
            self::CASH_APP => 'Cash App',
            self::VENMO => 'Venmo',
        ];
    }
}
