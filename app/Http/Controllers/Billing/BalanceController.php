<?php

namespace App\Http\Controllers\Billing;

use App\Http\Requests\Balance\UpdateRequest;
use App\Http\Requests\Balance\ShowRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Billing\ShowResource;
use App\Http\Resources\Billing\UpdateResource;
use App\Services\BillingService;

/**
 * Class BalanceController
 * @package App\Http\Controllers\Billing
 */
class BalanceController extends Controller
{
    /**
     * @var BillingService
     */
    public $service;

    /**
     * BalanceController constructor.
     * @param BillingService $service
     */
    public function __construct(BillingService $service)
    {
        $this->service = $service;
    }

    /**
     * Получение баланса.
     *
     * @param ShowRequest $request
     * @return ShowResource
     */
    public function show(ShowRequest $request): ShowResource
    {
        return new ShowResource($this->service->show($request->get('wallet_id')));
    }

    /**
     * Совершение операции.
     *
     * @param UpdateRequest $request
     * @return UpdateResource
     */
    public function update(UpdateRequest $request): UpdateResource
    {
        return new UpdateResource($this->service->update($request->all()));
    }
}
