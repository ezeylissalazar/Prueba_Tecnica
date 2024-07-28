<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyConversionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'from' => 'required',
            'to' => 'required',
            'amount' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'from.required' => 'from currency is required',
            'to.required' => 'to currency is required',
            'amount.required' => 'amount is required',
        ];
    }
}
