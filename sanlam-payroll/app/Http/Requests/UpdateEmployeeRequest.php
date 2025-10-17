<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
        $employeeId = $this->route('employee')?->id ?? null;

        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => ['sometimes', 'required', 'email', 'max:255', 'unique:employees,email,' . $employeeId],
            'napsa_number' => ['sometimes', 'required', 'string', 'max:255', 'unique:employees,napsa_number,' . $employeeId],
            'position' => ['sometimes', 'required', 'string', 'max:255'],
            'basic_salary' => ['sometimes', 'required', 'numeric', 'min:0'],
        ];
    }
}
