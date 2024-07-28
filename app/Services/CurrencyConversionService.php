<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CurrencyConversionService
{
    public function getConversionRate($from, $to)
    {
        $apiKey = env('EXCHANGE_RATE_API_KEY');
        $url = "https://v6.exchangerate-api.com/v6/$apiKey/latest/$from";

        $response = Http::get($url);

        if ($response->successful()) {
            $data = $response->json();
            return $data['conversion_rates'][$to] ?? null;
        }

        return null;
    }
}
