<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContributionRequest extends FormRequest
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
                    'contribution_type_id' => 'required|exists:contribution_types,id',
                    'member_id' => 'required|exists:members,id',
                    'paid_amount' => 'required|numeric|min:0',
                    'date' => 'required|date',
                    'remaining_amount' => 'nullable|numeric|min:0',
                    'status' => 'nullable|in:pending,completed,partial',
                ];
                break;

            case 'PUT':
            case 'PATCH':
                $rules = [
                    'contribution_type_id' => 'sometimes|required|exists:contribution_types,id',
                    'member_id' => 'sometimes|required|exists:members,id',
                    'paid_amount' => 'sometimes|required|numeric|min:0',
                    'date' => 'sometimes|required|date',
                    'remaining_amount' => 'sometimes|nullable|numeric|min:0',
                    'status' => 'sometimes|nullable|in:pending,completed,partial',
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
            'contribution_type_id.required' => 'Aina ya mchango ni lazima.',
            'contribution_type_id.exists' => 'Aina ya mchango iliyochaguliwa hayupo.',
            'member_id.required' => 'Id ya mwanachama ni lazima.',
            'member_id.exists' => 'Mwanachama aliyechaguliwa hayupo.',
            'paid_amount.required' => 'Kiasi kilicholipwa ni lazima.',
            'paid_amount.numeric' => 'Kiasi kilicholipwa kinapaswa kuwa namba.',
            'paid_amount.min' => 'Kiasi kilicholipwa kinapaswa kuwa si chini ya 0.',
            'date.required' => 'Tarehe ni lazima.',
            'date.date' => 'Tarehe si sahihi.',
            'remaining_amount.numeric' => 'Kiasi kilichosalia kinapaswa kuwa namba.',
            'remaining_amount.min' => 'Kiasi kilichosalia kinapaswa kuwa si chini ya 0.',
            'status.required' => 'Hali ya mchango ni lazima.',
            'status.in' => 'Hali ya mchango inapaswa kuwa moja kati ya pending, completed, or partial.',
        ];
    }
}
