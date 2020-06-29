<?php

namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CurrencyRates
 * @package App\Models\Billing
 * @property int $id
 * @property string $currency_from
 * @property string $currency_to
 * @property double $rate
 */
class CurrencyRates extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'currency_from',
        'currency_to',
        'rate',
    ];
}
