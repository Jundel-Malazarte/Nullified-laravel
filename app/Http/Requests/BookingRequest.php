<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'service_id' => ['required', 'exists:repair_services,id'],
            'device_name' => ['required', 'string', 'max:100'],
            'device_brand' => ['nullable', 'string', 'max:100'],
            'device_model' => ['nullable', 'string', 'max:100'],
            'issue_description' => ['required', 'string', 'min:10'],
            'preferred_date' => ['nullable', 'date', 'after_or_equal:today'],
            'preferred_time' => ['nullable', 'date_format:H:i'],
        ];
    }

    public function messages(): array
    {
        return [
            'service_id.required' => 'Please select a service.',
            'service_id.exists' => 'The selected service is invalid.',
            'device_name.required' => 'Please enter the device name.',
            'issue_description.required' => 'Please describe the issue.',
            'issue_description.min' => 'Please provide more details about the issue (at least 10 characters).',
            'preferred_date.after_or_equal' => 'Please select a future date.',
        ];
    }
}
