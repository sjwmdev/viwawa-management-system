<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $this->route('member') ? $this->route('member')->id : null;

        switch ($this->getMethod()) {
            case 'POST':
                return [
                    'first_name' => 'required|string|max:255',
                    'middle_name' => 'nullable|string|max:255',
                    'last_name' => 'required|string|max:255',
                    'email' => 'nullable|string|email|max:255|unique:users,email',
                    'phone_number' => 'nullable|string|max:12|unique:users,phone_number',
                    'gender' => 'required|in:male,female',
                    'residence' => 'nullable|string|max:255',
                    'occupation' => 'nullable|string|max:255',
                    'family_status' => 'nullable|in:single,married,divorced,widowed',
                    'presence_status' => 'nullable|in:active,inactive',
                ];

            case 'PUT':
            case 'PATCH':
                return [
                    'first_name' => 'sometimes|required|string|max:255',
                    'middle_name' => 'nullable|string|max:255',
                    'last_name' => 'sometimes|required|string|max:255',
                    'email' => 'sometimes|nullable|string|email|max:255|unique:users,email,' . $this->route('member')->user_id,
                    'phone_number' => 'sometimes|nullable|string|max:12|unique:users,phone_number,' . $this->route('member')->user_id,
                    'gender' => 'sometimes|required|in:male,female',
                    'residence' => 'nullable|string|max:255',
                    'occupation' => 'nullable|string|max:255',
                    'family_status' => 'nullable|in:single,married,divorced,widowed',
                    'presence_status' => 'sometimes|nullable|in:active,inactive',
                ];

            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Jina la kwanza linahitajika.',
            'first_name.string' => 'Jina la kwanza lazima liwe maandishi.',
            'first_name.max' => 'Jina la kwanza lisizidi herufi 255.',
            'middle_name.string' => 'Jina la kati lazima liwe maandishi.',
            'middle_name.max' => 'Jina la kati lisizidi herufi 255.',
            'last_name.required' => 'Jina la mwisho linahitajika.',
            'last_name.string' => 'Jina la mwisho lazima liwe maandishi.',
            'last_name.max' => 'Jina la mwisho lisizidi herufi 255.',
            'email.email' => 'Barua pepe lazima iwe sahihi.',
            'email.max' => 'Barua pepe isizidi herufi 255.',
            'email.unique' => 'Barua pepe tayari imetumika.',
            'phone_number.unique' => 'Namba ya simu tayari imetumika.',
            'phone_number.string' => 'Namba ya simu lazima liwe maandishi.',
            'phone_number.max' => 'Namba ya simu isizidi herufi 12.',
            'phone_number.unique' => 'Namba ya simu tayari imetumika.',
            'gender.required' => 'Jinsia inahitajika.',
            'gender.in' => 'Chagua jinsia sahihi.',
            'residence.string' => 'Makazi lazima liwe maandishi.',
            'residence.max' => 'Makazi isizidi herufi 255.',
            'occupation.string' => 'Kazi lazima liwe maandishi.',
            'occupation.max' => 'Kazi isizidi herufi 255.',
            'family_status.in' => 'Chagua hali ya familia sahihi.',
            'presence_status.required' => 'Hali ya kuwepo inahitajika.',
            'presence_status.in' => 'Chagua hali ya kuwepo sahihi.',
        ];
    }
}
