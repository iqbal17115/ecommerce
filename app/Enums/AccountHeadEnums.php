<?php

namespace App\Enums;

class AccountHeadEnums
{
    public const ASSETS = 'assets';
    public const EQUITY = 'equity';
    public const EXPENSE = 'expense';
    public const REVENUE = 'revenue';
    public const LIABILITIES = 'liabilities';

    public static function getValues()
    {
        // Define account head
        return [
            self::ASSETS => 'assets',
            self::EQUITY => 'equity',
            self::EXPENSE => 'expense',
            self::REVENUE => 'revenue',
            self::LIABILITIES => 'liabilities'
        ];
    }
}
