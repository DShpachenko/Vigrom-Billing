<?php

namespace App\Http\Requests\Balance;

use App\Http\Requests\Validation;

/**
 * Class ShowRequest
 * @package App\Http\Requests\Balance
 */
class ShowRequest extends Validation
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
            'exists' => __('validation.exists'),
        ];
    }
}
