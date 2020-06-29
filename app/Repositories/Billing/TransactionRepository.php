<?php

namespace App\Repositories\Billing;

use App\Models\Billing\Transaction;
use App\Repositories\Repository;

/**
 * Class TransactionRepository
 * @package App\Repositories\Billing
 */
class TransactionRepository extends Repository
{
    /**
     * Model name.
     *
     * @return mixed|string
     */
    public function model(): string
    {
        return Transaction::class;
    }

    /**
     * Получение списка типов операций.
     *
     * @return array
     */
    public static function getTypes(): array
    {
        return [
            Transaction::TYPE_CREDIT,
            Transaction::TYPE_DEBIT,
        ];
    }

    /**
     * Получение списка причин.
     *
     * @return array
     */
    public static function getReasons(): array
    {
        return [
            Transaction::REASON_REFUND,
            Transaction::REASON_STOCK,
        ];
    }

    /**
     * Расчет суммы для обновления баланса.
     *
     * @param string $type
     * @param float $sum
     * @return float|int
     */
    public function calculateSumByType(string $type, float $sum): float
    {
        return ($type === Transaction::TYPE_CREDIT) ? -1.0 * $sum : $sum;
    }
}
