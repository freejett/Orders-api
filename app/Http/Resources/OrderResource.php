<?php

namespace App\Http\Resources;

use App\Models\CurrencyRate;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
			'id' => $this->id,
			'number' => $this->number,
			'name' => $this->name,
			'order_sum' => $this->getOrderSumRub(),
			'currency_id' => $this->currency_id,
			'paid_at' => $this->paid_at,
        ];
    }

    /**
     * Стоимость заказа в рублях
     * Конвертация по курсу валют в день заказа если указана валюта
     * @return float
     */
    protected function getOrderSumRub(): float
    {
        if (is_null($this->currency_id)) {
            return $this->order_sum;
        }

        return $this->order_sum * CurrencyRate::getRateForDate(
            $this->currency_id,
            Carbon::createFromDate($this->paid_at)
        );
    }
}
