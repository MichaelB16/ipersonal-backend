<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EvaluationRequest extends FormRequest
{
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
            'student_id' => 'required|integer',
            'height' => 'required',
            'weight' => 'required|integer',
            'percent_weight' => 'required|integer',
            'arm' => 'required|integer',
            'leg' => 'required|integer',
            'waist' => 'required|integer',
            'breastplate' => 'required|integer',
            'observation' => 'nullable',
        ];
    }
}
