<?php

namespace App\Services;

use App\Enums\AccountHeadEnums;
use App\Enums\EntryTypeEnums;
use Exception;
use Illuminate\Support\Facades\DB;

class BalanceCalculationService
{
    /**
     * calculate previous balance
     *
     * @param $accountHead
     * @param $entryType
     * @param $currentBalance
     * @param $amount
     */
    public function previousBalance($accountHead, $entryType, $currentBalance, $amount)
    {
        DB::beginTransaction();
        try {
            $sign = $this->getSign($accountHead);

            // Calculate previous balance
            if ($entryType === EntryTypeEnums::DEBIT) {
                $previousBalance = $currentBalance - ($sign * $amount);
            } elseif ($entryType === EntryTypeEnums::CREDIT) {
                $previousBalance = $currentBalance + ($sign * $amount);
            }
            DB::commit();
            return $previousBalance;
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    /**
     * calculate current balance
     *
     * @param $accountHead
     * @param $entryType
     * @param $previousBalance
     * @param $amount
     */
    public function currentBalance($accountHead, $entryType, $previousBalance, $amount)
    {
        DB::beginTransaction();
        try {
            $sign = $this->getSign($accountHead);

            // Calculate current balance
            if ($entryType === EntryTypeEnums::DEBIT) {
                $currentBalance = $previousBalance + ($sign * $amount);
            } elseif ($entryType === EntryTypeEnums::CREDIT) {
                $currentBalance = $previousBalance - ($sign * $amount);
            }
            DB::commit();
            return $currentBalance;
        } catch (Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    /**
     * get sign
     *
     * @param $accountHead
     */
    public function getSign($accountHead)
    {
        return ($accountHead === AccountHeadEnums::LIABILITIES || $accountHead === AccountHeadEnums::REVENUE) ? -1 : 1;
    }
}
