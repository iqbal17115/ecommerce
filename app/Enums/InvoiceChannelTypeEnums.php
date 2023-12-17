<?php

namespace App\Enums;

class InvoiceChannelTypeEnums
{
    public const WEB_SALE = 'web_sale';
    public const TERMINAL_SALE = 'terminal_sale';

    public static function getValues()
    {
        // Define invoice channel type
        return [
            self::WEB_SALE => 'web_sale',
            self::TERMINAL_SALE => 'terminal_sale'
        ];
    }
}
