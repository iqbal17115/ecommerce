<?php

namespace App\Enums;

class EntryTypeEnums
{
    public const DEBIT = 'debit';
    public const CREDIT = 'credit';

    public static function getValues()
    {
        // Define entry type
        return [
            self::DEBIT => 'debit',
            self::CREDIT => 'credit'
        ];
    }
}
