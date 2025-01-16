<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Exceptions\CustomHttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class EmployeeUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() != null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => ['nullable', 'mimes:jpeg,png,jpg', 'max:2048'],
            'name' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'max:15'],
            'division' => ['nullable', 'exists:divisions,id'],
            'position' => ['nullable', 'string', 'max:255']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new CustomHttpResponseException($validator->errors()->first(), 400);
    }
}
