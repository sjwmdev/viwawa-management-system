<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'phone_number' => 'required|string|max:15|unique:users,phone_number',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'Jina la kwanza ni lazima.',
            'last_name.required' => 'Jina la mwisho ni lazima.',
            'email.required' => 'Barua pepe ni lazima.',
            'email.email' => 'Barua pepe lazima iwe sahihi.',
            'email.unique' => 'Barua pepe tayari imeshasajiliwa.',
            'phone_number.required' => 'Namba ya simu ni lazima.',
            'phone_number.unique' => 'Namba ya simu tayari imeshasajiliwa.',
            'password.required' => 'Nenosiri ni lazima.',
            'password.min' => 'Nenosiri lazima liwe na angalau herufi nane.',
            'password.confirmed' => 'Nenosiri lazima liwe sawa na thibitisha nenosiri.',
        ];
    }
}
