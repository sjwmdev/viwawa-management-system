<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IncomeRequest extends FormRequest
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
                    'income_type_id' => 'required|exists:income_type,id',
                    'amount' => 'required|numeric|min:0',
                    'date' => 'required|date',
                    'description' => 'nullable|string',
                ];
                break;

            case 'PUT':
            case 'PATCH':
                $rules = [
                    'income_type_id' => 'sometimes|required|exists:income_type,id',
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
            'income_type.required' => 'Aina ya kipato ni lazima.',
            'income_type.exists' => 'Aina ya kipato uliyochagua si sahihi.',
            'amount.required' => 'Kiasi cha kipato ni lazima.',
            'amount.numeric' => 'Kiasi cha kipato lazima kiwe namba.',
            'amount.min' => 'Kiasi cha kipato lazima kiwe si chini ya sifuri.',
            'date.required' => 'Tarehe ya kipato ni lazima.',
            'date.date' => 'Tarehe ya kipato lazima iwe tarehe sahihi.',
            'descriptions.string' => 'Maelezo lazima yawe maandishi.',
        ];
    }
}
