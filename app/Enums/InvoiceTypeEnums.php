<?php

namespace App\Enums;

class InvoiceTypeEnums
{
    public const SALE = 'sale';
    public const PURCHASE = 'purchase';

    public static function getValues()
    {
        // Define invoice type
        return [
            self::SALE => 'sale',
            self::PURCHASE => 'purchase'
        ];
    }
}
