<?php

namespace App\Models\Billing;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Wallet
 * @package App\Models\Billing
 * @property int $id
 * @property double $balance
 * @property string $currency
 */
class Wallet extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'balance',
        'currency'
    ];

    /**
     * @var string
     */
    protected $table = 'wallets';
}
