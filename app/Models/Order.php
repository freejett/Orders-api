<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['number','name','order_sum','currency_id','paid_at'];

    protected static function boot()
    {
        parent::boot();

        /**
         * Устанавливаем стоимость заказа по курсу в день оплаты при создании
         */
        self::creating(function($model) {
            if (!is_null($model->currency_id)) {
                $rate = CurrencyRate::getRateForDate($model->currency_id, Carbon::createFromDate($model->paid_at));
                $model->order_sum = $model->order_sum * $rate;
                $model->currency_id = null;
            }
        });
    }
}
