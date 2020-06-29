<?php

namespace App\Http\Resources\Billing;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ShowResource
 */
class ShowResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array|mixed
     */
    public function toArray($request)
    {
        return [
            'sum' => $this->resource,
        ];
    }
}
