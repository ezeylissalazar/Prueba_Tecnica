<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssociateActivityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'activities' => 'required|array|min:1',
        ];
    }

    public function messages()
    {
        return [
            'activities.required' => 'You must select at least one activity.',
            'activities.array' => 'The activities must be an array.',
            'activities.min' => 'You must select at least one activity.',
        ];
    }
}
