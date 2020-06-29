<?php

namespace App\Repositories\Billing;

use App\Repositories\Repository;

use App\Models\Billing\Wallet;

/**
 * Class WalletRepository
 * @package App\Repositories
 */
class WalletRepository extends Repository
{
    /**
     * Model name.
     *
     * @return mixed|string
     */
    public function model(): string
    {
        return Wallet::class;
    }

    /**
     * Обновление баланса кошелька.
     *
     * @param int $id
     * @param float $sum
     */
    public function updateBalance(int $id, float $sum): void
    {
        $wallet = $this->find($id);
        $wallet->balance += $sum;
        $wallet->save();
    }
}
