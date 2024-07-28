<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyConversionRequest;
use App\Models\CurrencyConversion;
use App\Services\CurrencyConversionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CurrencyConversionController extends Controller
{
    protected $currencyConversionService;

    public function __construct(CurrencyConversionService $currencyConversionService)
    {
        $this->currencyConversionService = $currencyConversionService;
    }

    public function convert(CurrencyConversionRequest $request)
    {
        try {
            DB::beginTransaction();
            $from = $request->input('from');
            $to = $request->input('to');
            $amount = $request->input('amount');

            $conversion = CurrencyConversion::where('from_currency', $from)
                ->where('to_currency', $to)
                ->first();

            if ($conversion) {
                $rate = $conversion->rate;
            } else {
                $rate = $this->currencyConversionService->getConversionRate($from, $to);

                if ($rate) {
                    CurrencyConversion::create([
                        'from_currency' => $from,
                        'to_currency' => $to,
                        'rate' => $rate,
                    ]);
                }
            }

            if ($rate) {
                $convertedAmount = $amount * $rate;
                DB::commit();

                return redirect()->back()->with([
                    'result' => [
                        'rate' => $rate,
                        'converted_amount' => $convertedAmount,
                    ],
                    'success' => 'Conversion Completed Successfully.',
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Conversion rate not found. ' . $e->getMessage());
        }
    }

    public function showForm()
    {
        $currencies = ['USD', 'EUR', 'GBP', 'JPY', 'AUD', 'CAD', 'CHF', 'CNY', 'SEK', 'NZD'];
        return view('convert.index', compact('currencies'));
    }
}
