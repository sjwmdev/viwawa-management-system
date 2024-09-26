<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChurchContributionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Assuming all authorized users can make this request
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
                    'family_name' => 'required|string|max:255',
                    'amount' => 'required|numeric|min:0',
                    'description' => 'nullable|string|max:1000',
                    'contribution_date' => 'nullable|date',
                    'month' => 'required|string|max:2',
                    'year' => 'required|numeric|min:1900|max:' . date('Y'),
                    'contribution_type_id' => 'required|exists:contribution_types,id',
                    'status' => 'required|in:paid,not_paid,ahadi',
                ];
                break;

            case 'PUT':
            case 'PATCH':
                $rules = [
                    'family_name' => 'sometimes|required|string|max:255',
                    'amount' => 'sometimes|required|numeric|min:0',
                    'description' => 'sometimes|nullable|string|max:1000',
                    'contribution_date' => 'sometimes|nullable|date',
                    'month' => 'sometimes|required|string|max:2',
                    'year' => 'sometimes|required|numeric|min:1900|max:' . date('Y'),
                    'contribution_type_id' => 'sometimes|required|exists:contribution_types,id',
                    'status' => 'sometimes|required|in:paid,not_paid,ahadi',
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
            'family_name.required' => 'Jina la familia ni lazima.',
            'family_name.string' => 'Jina la familia lazima liwe herufi.',
            'family_name.max' => 'Jina la familia lisizidi herufi 255.',
            'amount.required' => 'Kiasi kilicholipwa ni lazima.',
            'amount.numeric' => 'Kiasi kilicholipwa lazima kiwe namba.',
            'amount.min' => 'Kiasi kilicholipwa lazima kiwe na thamani ya si chini ya 0.',
            'description.string' => 'Maelezo lazima yawe herufi.',
            'description.max' => 'Maelezo yasizidi herufi 1000.',
            'contribution_date.required' => 'Tarehe ya mchango ni lazima.',
            'contribution_date.date' => 'Tarehe ya mchango lazima iwe sahihi.',
            'month.required' => 'Mwezi wa mchango ni lazima.',
            'month.string' => 'Mwezi lazima uwe herufi.',
            'month.max' => 'Mwezi lazima uwe na herufi mbili.',
            'year.required' => 'Mwaka wa mchango ni lazima.',
            'year.numeric' => 'Mwaka wa mchango lazima uwe namba.',
            'year.min' => 'Mwaka wa mchango lazima uwe si chini ya 1900.',
            'year.max' => 'Mwaka wa mchango lazima uwe si zaidi ya mwaka wa sasa.',
            'contribution_type_id.required' => 'Aina ya mchango ni lazima.',
            'contribution_type_id.exists' => 'Aina ya mchango iliyochaguliwa haipo.',
            'status.required' => 'Hali ya mchango ni lazima.',
            'status.in' => 'Hali ya mchango lazima iwe moja kati ya: paid, not_paid, au ahadi.',
        ];
    }
}
