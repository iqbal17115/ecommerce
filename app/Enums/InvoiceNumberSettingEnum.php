<?php

namespace App\Enums;

class InvoiceNumberSettingEnum
{
    public const EXPENSE = 'expense';
    public const REVENUE = 'revenue';
    public const MONEY_TRANSFER = 'money_transfer';
    public const MANUAL_JOURNAL = 'manual_journal';
    public const COMMISSION = 'commission';
    public const PURCHASE = 'purchase';
    public const SALE = 'sale';
    public const ORDER = 'order';

    public static function getValues()
    {
        // Define account head
        return [
            self::EXPENSE => 'expense',
            self::REVENUE => 'revenue',
            self::MONEY_TRANSFER => 'money_transfer',
            self::MANUAL_JOURNAL => 'manual_journal',
            self::COMMISSION => 'commission',
            self::PURCHASE => 'purchase',
            self::SALE => 'sale',
            self::ORDER => 'order'
        ];
    }
}
