<?php

namespace App\Repositories\Billing;

use App\Models\Billing\CurrencyRates;
use App\Repositories\Repository;

/**
 * Class CurrencyRatesRepository
 * @package App\Repositories\Billing
 */
class CurrencyRatesRepository extends Repository
{
    /**
     * Model name.
     *
     * @return mixed|string
     */
    public function model(): string
    {
        return CurrencyRates::class;
    }

    /**
     * @param string $currencyFrom
     * @param string $currencyTo
     * @param float $sum
     * @return float|null
     */
    public function calculateRateSum(string $currencyFrom, string $currencyTo, float $sum): ? float
    {
        if ($currencyFrom === $currencyTo) {
            return $sum;
        }

        $row = $this->model
            ->where('currency_from', $currencyFrom)
            ->where('currency_to', $currencyTo)
            ->first();

        return $row->rate * $sum;
    }
}
