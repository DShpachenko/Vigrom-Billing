<?php

namespace App\Services;

use App\Exceptions\BillingException;
use App\Models\Billing\Transaction;
use App\Repositories\Billing\CurrencyRatesRepository;
use App\Repositories\Billing\TransactionRepository;
use App\Repositories\Billing\WalletRepository;
use Illuminate\Support\Facades\DB;
use App\Jobs\BillingTransaction;

/**
 * Class BillingService
 * @package App\Services
 */
class BillingService
{
    /**
     * @var WalletRepository
     */
    public $wallet;

    /**
     * @var TransactionRepository
     */
    public $transaction;

    /**
     * @var CurrencyRatesRepository
     */
    public $rates;

    /**
     * BillingService constructor.
     * @param WalletRepository $walletRepository
     * @param TransactionRepository $transactionRepository
     * @param CurrencyRatesRepository $rates
     */
    public function __construct(WalletRepository $walletRepository, TransactionRepository $transactionRepository, CurrencyRatesRepository $rates)
    {
        $this->rates = $rates;
        $this->wallet = $walletRepository;
        $this->transaction = $transactionRepository;
    }

    /**
     * Получение баланса.
     *
     * @param int $id
     * @return float|null
     */
    public function show(int $id): ? float
    {
        return $this->wallet->find($id)->balance;
    }

    /**
     * Создание задачи на обновление баланса.
     *
     * @param array $data
     * @return bool|null
     */
    public function update(array $data): ? bool
    {
        if (dispatch(new BillingTransaction($data))) {
            return true;
        }

        return false;
    }

    /**
     * Обработка обновления баланса.
     *
     * @param array $data
     * @return bool|null
     * @throws \Exception
     */
    public function updatingProcess(array $data): ? bool
    {
        $wallet = $this->wallet->find($data['wallet_id']);
        $sum = $this->rates->calculateRateSum($data['currency'], $wallet['currency'], $data['sum']);

        if ((Transaction::TYPE_CREDIT === $data['type']) && ($wallet->balance - $sum) < 0) {
            throw new BillingException(__('billing.max_credit_sum'));
        }

        DB::beginTransaction();
        if ($this->transaction->create($data)) {
            $this->wallet->updateBalance($data['wallet_id'], $this->transaction->calculateSumByType($data['type'], $sum));
            DB::commit();

            return true;
        }

        DB::rollBack();

        throw new BillingException(__('billing.server_error'));
    }
}
