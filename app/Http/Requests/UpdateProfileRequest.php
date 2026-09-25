<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:150', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => ['required', 'email', 'max:150', Rule::unique('users')->ignore(auth()->id())],
            'phone' => ['nullable', 'string', 'max:30', 'regex:/^[0-9+\-\s()]+$/'],
            'address' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'province' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'preferred_contact' => ['nullable', 'in:email,sms,phone'],
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'Full name is required.',
            'full_name.regex' => 'Name should only contain letters and spaces.',
            'email.required' => 'Email is required.',
            'email.unique' => 'This email is already taken.',
            'phone.regex' => 'Please enter a valid phone number.',
        ];
    }
}
