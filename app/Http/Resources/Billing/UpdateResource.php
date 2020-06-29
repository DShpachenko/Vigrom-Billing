<?php

namespace App\Http\Resources\Billing;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class UpdateResource
 */
class UpdateResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array|mixed
     */
    public function toArray($request)
    {
        return [
            'update' => $this->resource ? 'Успешно!' : 'Ошибка!',
        ];
    }
}
