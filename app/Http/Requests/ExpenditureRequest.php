<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenditureRequest extends FormRequest
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
                    'amount' => 'required|numeric|min:0',
                    'date' => 'required|date',
                    'description' => 'nullable|string',
                ];
                break;

            case 'PUT':
            case 'PATCH':
                $rules = [
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
            'amount.required' => 'Kiasi cha matumizi ni lazima.',
            'amount.numeric' => 'Kiasi cha matumizi lazima kiwe namba.',
            'amount.min' => 'Kiasi cha matumizi lazima kiwe si chini ya sifuri.',
            'date.required' => 'Tarehe ya matumizi ni lazima.',
            'date.date' => 'Tarehe ya matumizi lazima iwe tarehe sahihi.',
            'description.string' => 'Maelezo lazima yawe maandishi.',
        ];
    }
}
