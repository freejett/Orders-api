<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyRate extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['currency_id', 'rate', 'receiving_date'];

    /**
     * Вернуть курс валюты для выбранной даты
     * @param int $currencyId
     * @param Carbon $paidAt
     * @return float|null
     */
    public static function getRateForDate(int $currencyId, Carbon $paidAt): float|null
    {
        return self::where('receiving_date', $paidAt->format('Y-m-d'))
            ->where('currency_id', $currencyId)
            ->pluck('rate')
            ->first();
    }
}
