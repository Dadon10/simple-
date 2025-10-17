<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePayrollRequest extends FormRequest
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
            'employee_id' => ['sometimes', 'required', 'exists:employees,id'],
            'month' => ['sometimes', 'required', 'string', 'max:7'],
            'gross_salary' => ['sometimes', 'required', 'numeric', 'min:0'],
            'deductions' => ['nullable', 'numeric', 'min:0'],
            'net_salary' => ['sometimes', 'required', 'numeric', 'min:0'],
        ];
    }
}
