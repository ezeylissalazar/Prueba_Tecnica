<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeActivityRequest extends FormRequest
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
            'name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'name is required',
        ];
    }
}
