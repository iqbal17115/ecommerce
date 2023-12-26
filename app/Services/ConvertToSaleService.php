<?php

namespace App\Services;

use App\Enums\OrderStatusEnum;
use App\Models\Account;
use App\Models\JournalEntry;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Transaction;
use App\Models\InvoiceNumberSetting;
use App\Enums\InvoiceNumberSettingEnum;
use App\Helpers\Utils;
use App\Traits\BaseModel;
use Exception;
use Illuminate\Support\Facades\DB;

class ConvertToSaleService extends TransactionService
{
    use BaseModel;

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
            if($order->sale) {
                return $order->sale;
            }
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
                    'sale_id' => OrderStatusEnum::PROCESSING,
                    'status' => $sale->id,
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
