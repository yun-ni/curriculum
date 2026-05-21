<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateVisit extends FormRequest
{
    protected $errorBag = 'visit';
    
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
            'visit_date' => 'required|date',
            'has_visit' => 'required|in:0,1',
            'hospital_name' => 'nullable|max:50',
            'symptom' => 'required|max:200',
            'medication' => 'nullable|max:200',
            'prescription' => 'nullable|max:200',
            'medical_fees' => 'nullable|integer|min:0|digits_between:1,10',
            'memo' => 'nullable|max:1000',
        ];
    }
}
