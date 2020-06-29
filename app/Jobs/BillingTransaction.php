<?php

namespace App\Jobs;

use App\Exceptions\BillingException;
use Illuminate\Support\Facades\Cache;
use App\Services\BillingService;

/**
 * Class BillingTransaction
 * @package App\Jobs
 */
class BillingTransaction extends Job
{
    /**
     * @var array
     */
    protected $data;

    /**
     * BillingTransaction constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @param BillingService $service
     * @return void
     * @throws \Exception
     */
    public function handle(BillingService $service): void
    {
        $key = 'billing-by-wallet-id:'.$this->data['wallet_id'];

        if (Cache::get($key)) {
            throw new BillingException('Операция в обработке', 404);
        }

        Cache::put($key, true, 2);

        if ($service->updatingProcess($this->data)) {
            Cache::forget($key);
        }
    }
}
