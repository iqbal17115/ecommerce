<?php

namespace App\Http\Requests\AdminPanel\MakePayment;

use App\Rules\AdminPanel\ValidOrderPaymentAmount;
use Illuminate\Foundation\Http\FormRequest;

class MakePaymentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order_id' => ['required', 'exists:orders,id'],
            'date' => ['required', 'date'],
            'payment_type' => [
                'required'
            ],
            'amount' => ['required', 'numeric', 'min:0.01', new ValidOrderPaymentAmount($this->order_id)],
            'note' => ['nullable', 'string', 'max:255'],
        ];
    }
}
