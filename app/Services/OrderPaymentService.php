<?php

namespace App\Services;

use App\Enums\PaymentStatusEnum;
use App\Models\Backend\Transaction\Payment;
use App\Models\FrontEnd\Order;
use App\Models\OrderPayment;
use App\Models\OrderPaymentDetail;
use Exception;
use Illuminate\Support\Facades\DB;

class OrderPaymentService
{
    /**
     * Make a payment for an order.
     *
     * @param array $data
     * @return OrderPayment
     * @throws Exception
     */
    public function makePayment(array $data): OrderPayment
    {
        DB::beginTransaction();

        try {
            // Retrieve or create the order payment record
            $orderPayment = $this->getOrderPayment($data['order_id']);

            // Create payment detail
            $this->createPaymentDetail($orderPayment->id, $data);

            // Update order payment summary
            $this->updateOrderPaymentSummary($orderPayment, $data['amount']);

            DB::commit();

            return $orderPayment;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception("Payment failed: " . $e->getMessage());
        }
    }

    /**
     * Retrieve the order payment record or fail.
     *
     * @param string $orderId
     * @return OrderPayment
     * @throws Exception
     */
    private function getOrderPayment(string $orderId): OrderPayment
    {
        return OrderPayment::where('order_id', $orderId)->firstOrFail();
    }

    /**
     * Create an order payment detail record.
     *
     * @param string $orderPaymentId
     * @param array $data
     * @return OrderPaymentDetail
     */
    private function createPaymentDetail(string $orderPaymentId, array $data): OrderPaymentDetail
    {
        return OrderPaymentDetail::create([
            'order_payment_id' => $orderPaymentId,
            'date' => $data['date'] ?? now()->format('Y-m-d'),
            'payment_type' => $data['payment_type'],
            'payment_method' => $data['payment_type'],
            'amount' => $data['amount'],
            'card_number' => $data['card_number'] ?? null,
            'transaction_number' => $data['transaction_number'] ?? null,
            'bank_name' => $data['bank_name'] ?? null,
            'cheque_number' => $data['cheque_number'] ?? null,
            'note' => $data['note'] ?? null,
            'is_successful' => true,
        ]);
    }

    /**
     * Update the order payment summary after a payment.
     *
     * @param OrderPayment $orderPayment
     * @param float $amount
     * @return void
     */
    private function updateOrderPaymentSummary(OrderPayment $orderPayment, float $amount): void
    {
        // Calculate new amount paid and due amount
        $newAmountPaid = $orderPayment->amount_paid + $amount;
        $newDueAmount = max(0, $orderPayment->due_amount - $amount);
        $paymentStatus = $this->determinePaymentStatus($newDueAmount);

        // Update the order payment summary
        $orderPayment->update([
            'amount_paid' => $newAmountPaid,
            'due_amount' => $newDueAmount,
            'payment_status' => $paymentStatus,
        ]);
    }

    /**
     * Determine payment status based on due amount.
     *
     * @param float $dueAmount
     * @return string
     */
    private function determinePaymentStatus(float $dueAmount): string
    {
        return $dueAmount == 0 ? PaymentStatusEnum::PAID : PaymentStatusEnum::PARTIALLY_PAID;
    }

    /**
     * Handle order payment status update.
     *
     * @param Order $order
     * @param string $paymentStatus
     * @return void
     * @throws Exception
     */
    public function handleOrderPaymentStatus(Order $order, string $paymentStatus): void
    {
        // Retrieve order payment record
        $orderPayment = OrderPayment::where('order_id', $order->id)->first();

        if (!$orderPayment) {
            throw new Exception('Order payment record not found.');
        }

        // If status is "paid" and there's a due amount, process payment
        if (($paymentStatus === strtolower(PaymentStatusEnum::PAID) || $paymentStatus === strtolower(PaymentStatusEnum::COMPLETE)) && $orderPayment->due_amount > 0) {
            $this->makePayment([
                'order_id' => $order->id,
                'payment_type' => 'cash', // Default to cash
                'amount' => $orderPayment->due_amount, // Pay off the due amount
                'date' => now()->format('Y-m-d'),
                'note' => 'Auto-payment for full due amount',
            ]);
        }

        // Update payment status
        $orderPayment->update(['payment_status' => $paymentStatus]);
    }
}
