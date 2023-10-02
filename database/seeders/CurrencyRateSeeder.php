<?php

namespace Database\Seeders;

use App\Models\CurrencyRate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class CurrencyRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i <= 30; $i++) {
            CurrencyRate::factory()->state(function ($item, $key) use ($i) {
                return [
                    'currency_id' => 1,
                    'rate' => rand(5000, 15000) / 100,
                    'receiving_date' => date('Y-m-d', strtotime("-$i days", strtotime("now"))),
                ];
            })->create();
        }

        for ($i = 0; $i <= 30; $i++) {
            CurrencyRate::factory()->state(function ($item, $key) use ($i) {
                return [
                    'currency_id' => 2,
                    'rate' => rand(7000, 17000) / 100,
                    'receiving_date' => date('Y-m-d', strtotime("-$i days", strtotime("now"))),
                ];
            })->create();
        }
    }
}
