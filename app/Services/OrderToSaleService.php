<?php

namespace App\Services;

use App\Enums\EntryTypeEnum;
use App\Enums\EntryTypeEnums;
use App\Enums\TransactionTypeEnums;
use App\Models\Account;
use App\Models\Commission;
use App\Models\CommissionSupplier;
use App\Models\JournalEntry;
use App\Models\Transaction;
use Exception;
use Illuminate\Support\Facades\DB;

class OrderToSaleService extends TransactionService
{
    /**
     * Create or update supplier commission
     *
     * @param $supplierId
     * @param $totalAmount
     */
    public function createOrUpdateSupplierCommission($supplierId, $totalAmount): void
    {
        try {
            CommissionSupplier::updateOrCreate(
                ['supplier_id' => $supplierId],
                [
                    'amount' => DB::raw('amount + ' . $totalAmount)
                ]
            );

        } catch (Exception $ex) {

            // Re-throw the exception to be handled at a higher level
            throw $ex;
        }
    }

    /**
     * Create commission
     *
     * @param $commission
     * @param $commissionProducts
     */
    public function createCommissionProducts($commission, $commissionProducts): void
    {
        try {
            $commission->commissionProducts()->createMany(
                collect($commissionProducts)->map(function ($product) {
                    return [
                        'product_id' => $product['product_id'],
                        'purchase_qty' => $product['purchase_qty'],
                        'per_qty_amount' => $product['per_qty_amount'],
                        'total_amount' => $product['purchase_qty'] * $product['per_qty_amount'],
                    ];
                })->toArray()
            );

        } catch (Exception $ex) {

            // Re-throw the exception to be handled at a higher level
            throw $ex;
        }
    }

    /**
     * Create commission
     *
     * @param Transaction $transaction
     * @param $validateData
     */
    public function createCommission($transaction, $validateData): Commission
    {
        try {
            $commission = Commission::create([
                'commission_date' => $validateData['date'],
                'supplier_id' => $validateData['supplier_id'],
                'transaction_id' => $transaction->id,
                'commission_note' => $validateData['commission_note']
            ]);

            return $commission;
        } catch (Exception $ex) {

            // Re-throw the exception to be handled at a higher level
            throw $ex;
        }
    }

    /**
     * Create a journal entry for a specific account
     *
     * @param Transaction $transaction
     * @param $account
     * @param $totalAmount
     * @param $transactionType
     * @param $entryType
     */
    public function createJournalEntry($transaction, $account, $totalAmount, $transactionType, $entryType): void
    {
        DB::beginTransaction();
        try {
            $currentBalance = (new BalanceCalculationService())->currentBalance($account->accountCategory->account_head, $entryType, $account->current_balance, $totalAmount);

            // Journal Entry
            JournalEntry::create([
                'transaction_id' => $transaction->id,
                'account_id' => $account->id,
                'amount' => $totalAmount,
                'current_balance' => $currentBalance,
                'entry_type' => $entryType,
                'notes' => $transactionType . ': ',
            ]);

            $this->updateCurrentBalance($account, $currentBalance);
            DB::commit();
        } catch (Exception $ex) {
            DB::rollBack();

            // Re-throw the exception to be handled at a higher level
            throw $ex;
        }
    }

    /**
     * Store Commission Process
     *
     * @param $validatedData
     * @return Commission
     * @throws Exception
     */
    public function store(array $validatedData)
    {
        DB::beginTransaction();
        try {
            $sale = $this->convertToSale($validatedData);

            // Call createTransaction function
            $validatedData['description'] = 'Sale';
            $transaction = $this->createTransaction(TransactionTypeEnums::SALE, $validatedData);

            // Call journal for debit entry
            $account = $this->getAccountByName(config('settings.transaction_account_name.sale_debit_account_name'));
            $this->createJournalEntry($transaction, $account, $totalAmount, TransactionTypeEnums::SALE, EntryTypeEnums::DEBIT);

            // Call journal for credit entry
            $account = $this->getAccountByName(config('settings.transaction_account_name.sale_credit_account_name'));
            $this->createJournalEntry($transaction, $account, $totalAmount, TransactionTypeEnums::SALE, EntryTypeEnums::CREDIT);

            // Create commission
            $commission = $this->createCommission($transaction, $validatedData);

            // Create commission product
            $this->createCommissionProducts($commission, $validatedData['commission_products']);

            // Create or update supplier commission
            $this->createOrUpdateSupplierCommission($validatedData['supplier_id'], $totalAmount);

            DB::commit();

            return $commission;
        } catch (Exception $ex) {
            DB::rollBack();

            // Re-throw the exception to be handled at a higher level
            throw $ex;
        }
    }

    /**
     * Calculate Total Amount
     *
     * @param $commissionProducts
     */
    function calculateTotalAmount($commissionProducts)
    {
        return collect($commissionProducts)->sum(function ($product) {
            return $product['purchase_qty'] * $product['per_qty_amount'];
        });
    }

    /**
     * Get account by name
     *
     * @param $accountName
     */
    function getAccountByName($accountName)
    {
        return Account::where('name', $accountName)->first();
    }
}
