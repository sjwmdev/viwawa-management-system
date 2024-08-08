<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $userId = $this->route('user') ? $this->route('user')->id : null;

        switch ($this->getMethod()) {
            case 'POST':
                return [
                    'first_name' => 'required|string|max:255',
                    'middle_name' => 'nullable|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'email' => 'nullable|string|email|max:255|unique:users,email',
                    'phone_number' => 'nullable|string|max:15|unique:users,phone_number',
                    'password' => 'nullable|string|min:8|confirmed',
                    'role' => 'required|exists:roles,id',
                ];

            case 'PUT':
            case 'PATCH':
                return [
                    'first_name' => 'sometimes|required|string|max:255',
                    'middle_name' => 'nullable|string|max:255',
                    'last_name' => 'sometimes|required|string|max:255',
                    'email' => 'sometimes|nullable|string|email|max:255|unique:users,email,' . $userId,
                    'phone_number' => 'sometimes|nullable|string|max:15|unique:users,phone_number,' . $userId,
                    'password' => 'nullable|string|min:8|confirmed',
                    'role' => 'required|exists:roles,id',
                ];

            default:
                return [];
        }
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'first_name.required' => 'Jina la kwanza ni lazima.',
            'first_name.string' => 'Jina la kwanza lazima liwe maandishi.',
            'first_name.max' => 'Jina la kwanza lisizidi herufi 255.',
            'middle_name.string' => 'Jina la kati lazima liwe maandishi.',
            'middle_name.max' => 'Jina la kati lisizidi herufi 255.',
            'last_name.required' => 'Jina la mwisho ni lazima.',
            'last_name.string' => 'Jina la mwisho lazima liwe maandishi.',
            'last_name.max' => 'Jina la mwisho lisizidi herufi 255.',
            'email.required' => 'Barua pepe ni lazima.',
            'email.string' => 'Barua pepe lazima iwe maandishi.',
            'email.email' => 'Barua pepe lazima iwe sahihi.',
            'email.max' => 'Barua pepe isizidi herufi 255.',
            'email.unique' => 'Barua pepe tayari imeshasajiliwa.',
            'phone_number.required' => 'Namba ya simu ni lazima.',
            'phone_number.string' => 'Namba ya simu lazima iwe maandishi.',
            'phone_number.max' => 'Namba ya simu isizidi herufi 15.',
            'phone_number.unique' => 'Namba ya simu tayari imeshasajiliwa.',
            'password.required' => 'Nenosiri ni lazima.',
            'password.string' => 'Nenosiri lazima liwe maandishi.',
            'password.min' => 'Nenosiri lazima liwe na angalau herufi 8.',
            'password.confirmed' => 'Uthibitisho wa nenosiri haufanani.',
            'role.required' => 'Jukumu ni lazima.',
            'role.exists' => 'Jukumu lililochaguliwa halipo.',
        ];
    }
}
