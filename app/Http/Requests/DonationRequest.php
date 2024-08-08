<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DonationRequest extends FormRequest
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
        $rules = [];

        switch ($this->getMethod()) {
            case 'POST':
                $rules = [
                    'member_id' => 'required|exists:members,id',
                    'amount' => 'required|numeric|min:0',
                    'date' => 'required|date',
                    'description' => 'nullable|string',
                ];
                break;

            case 'PUT':
            case 'PATCH':
                $rules = [
                    'member_id' => 'sometimes|required|exists:members,id',
                    'amount' => 'sometimes|required|numeric|min:0',
                    'date' => 'sometimes|required|date',
                    'description' => 'sometimes|nullable|string',
                ];
                break;
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'member_id.required' => 'Id ya mwanachama ni lazima.',
            'member_id.exists' => 'Mwanachama aliyechaguliwa hayupo.',
            'amount.required' => 'Kiasi ni lazima.',
            'amount.numeric' => 'Kiasi kinapaswa kuwa namba.',
            'amount.min' => 'Kiasi kinapaswa kuwa si chini ya 0.',
            'date.required' => 'Tarehe ni lazima.',
            'date.date' => 'Tarehe si sahihi.',
            'description.string' => 'Maelezo yanapaswa kuwa maandishi.',
        ];
    }
}
