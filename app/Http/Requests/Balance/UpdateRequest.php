<?php

namespace App\Http\Requests\Balance;

use App\Http\Requests\Validation;

/**
 * Class UpdateRequest
 * @package App\Http\Requests\Balance
 */
class UpdateRequest extends Validation
{
    /**
     * Список правил валидации.
     *
     * @return array|string[]
     */
    public function rules(): array
    {
        return [
            'wallet_id' => 'required|integer|exists:wallets,id',
            'type' => 'required|string|in:debit,credit',
            'sum' => 'required|numeric',
            'currency' => 'required|string|in:USD,RUB',
            'reason' => 'required|string|in:stock,refund',
        ];
    }

    /**
     * Возврат списка сообщений при валидации.
     *
     * @return array|string[]
     */
    public function messages(): array
    {
        return [
            'required' => __('validation.required'),
            'integer' => __('validation.integer'),
            'string' => __('validation.string'),
            'numeric' => __('validation.double'),
            'exists' => __('validation.exists'),
            'in' => __('validation.in'),
        ];
    }
}
