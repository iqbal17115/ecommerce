<?php

namespace App\Rules\AdminPanel;

use App\Models\OrderPayment;
use Illuminate\Contracts\Validation\Rule;

class ValidOrderPaymentAmount implements Rule
{
    private $orderId;

    /**
     * Create a new rule instance.
     *
     * @param string $orderId
     */
    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $orderPayment = OrderPayment::where('order_id', $this->orderId)->first();

        if (!$orderPayment) {
            return false;
        }

        return $value <= $orderPayment->due_amount;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The payment amount exceeds the due amount.';
    }
}
