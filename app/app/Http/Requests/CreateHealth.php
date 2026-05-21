<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateHealth extends FormRequest
{
    protected $errorBag = 'health';

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'health_date' => 'required|date',
            'energy' => 'required',
            'appetite' => 'required',
            'toilets' => 'required',
            'walk_minutes' => 'nullable|integer|min:0',
            'weight' => 'nullable|numeric|min:0',
        ];
    }
}
