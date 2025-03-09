<?php

namespace App\Rules\MyAccount;

use App\Models\FrontEnd\OrderDetail;
use Illuminate\Contracts\Validation\Rule;

class ValidReturnQuantity implements Rule
{
    protected $orderDetailId;

    /**
     * Create a new rule instance.
     *
     * @param int $orderDetailId
     * @return void
     */
    public function __construct($orderDetailId)
    {
        $this->orderDetailId = $orderDetailId;
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
        $orderDetail = OrderDetail::find($this->orderDetailId);

        if (!$orderDetail) {
            return false; // Order detail not found
        }

        return $value <= $orderDetail->quantity; // Check if return quantity is less than or equal to ordered quantity
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The return quantity must be less than or equal to the ordered quantity.';
    }
}
