<?php

namespace App\Services;

use App\Enums\EntryTypeEnums;
use App\Enums\OrderStatusEnum;
use App\Enums\TransactionTypeEnums;
use App\Models\Account;
use App\Models\Commission;
use App\Models\CommissionSupplier;
use App\Models\JournalEntry;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Transaction;
use App\Models\InvoiceNumberSetting;
use App\Enums\InvoiceNumberSettingEnum;
use App\Helpers\Utils;
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

    public function convertToSale($order): Sale
    {
        DB::beginTransaction();
        try {
            $sale = Sale::create([
                'invoice_no' => $this->getLatestPurchaseInvoiceNumber(),
                'order_id' => $order->id,
                'user_id' => $order->user_id,
                'date' => $order->order_date,
                'total_amount' => $order->total_amount,
                'discount' => $order->discount,
                'shipping_charge' => $order->shipping_charge,
                'payable_amount' => $order->payable_amount,
                'invoice_channel' => 'web_sale'
            ]);

            foreach ($order->OrderDetail as $orderDetail) {
                SaleDetail::create([
                    'sale_id' => $sale->id,
                    'product_id' => $orderDetail->product_id,
                    'unit_price' => $orderDetail->unit_price,
                    'quantity' => $orderDetail->quantity,
                    'total_price' => $orderDetail->unit_price * $orderDetail->quantity,
                ]);
            }

            // Update order status
            $order->update(['status' => OrderStatusEnum::PROCESSING]);

            DB::commit();

            return $sale;
        } catch (Exception $ex) {
            DB::rollBack();

            // Re-throw the exception to be handled at a higher level
            throw $ex;
        }
    }
    /**
     * Store Sale
     *
     * @param $order
     * @throws Exception
     */
    public function store($order): Sale
    {
        DB::beginTransaction();
        try {
            $sale = $this->convertToSale($order);

            // Call createTransaction function
            $sale['note'] = 'Sale';
            $transaction = $this->createTransaction(TransactionTypeEnums::SALE, $sale);

            // Call journal for debit entry
            $account = $this->getAccountByName(config('settings.transaction_account_name.sale_debit_account_name'));
            $this->createJournalEntry($transaction, $account, $sale->payable_amount, TransactionTypeEnums::SALE, EntryTypeEnums::DEBIT);

            // Call journal for credit entry
            $account = $this->getAccountByName(config('settings.transaction_account_name.sale_credit_account_name'));
            $this->createJournalEntry($transaction, $account, $sale->payable_amount, TransactionTypeEnums::SALE, EntryTypeEnums::CREDIT);

            DB::commit();

            return $sale;
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

    /**
     * Generate Latest Purchase Invoice Number
     *
     * @return string
     */
    protected function getLatestPurchaseInvoiceNumber(): string
    {
        //Get Latest Purchase Data
        $result = Sale::latest();
        //Get Invoice Number Prefix
        $invoiceNumberPrefix = InvoiceNumberSetting::getPrefixByType(InvoiceNumberSettingEnum::PURCHASE);
        //Generate Order No
        return Utils::generateInvoiceNumber($result->first()->invoice_no ?? 'Invoice', $invoiceNumberPrefix);
    }
}
