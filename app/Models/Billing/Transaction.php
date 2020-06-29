<?php

namespace App\Models\Billing;

use App\Observers\TransactionObserver;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Transaction
 * @package App\Models\Billing
 * @property int $id
 * @property int $wallet_id
 * @property string $currency_id
 * @property double $sum
 * @property string $type
 * @property string $reason
 */
class Transaction extends Model
{
    /**
     * Типы операций.
     */
    public const TYPE_DEBIT = 'debit';
    public const TYPE_CREDIT = 'credit';

    /**
     * Причины операций.
     */
    public const REASON_STOCK = 'stock';
    public const REASON_REFUND = 'refund';

    /**
     * @var string[]
     */
    protected $fillable = [
        'sum',
        'type',
        'reason',
        'currency',
        'wallet_id',
    ];

    /**
     * @var string
     */
    protected $table = 'transactions';
}
