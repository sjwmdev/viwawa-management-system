<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContributionTypeRequest extends FormRequest
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
        $method = $this->getMethod();
        $route = $this->route('type');

        switch ($method) {
            case 'POST':
                $rules = [
                    'name' => 'required|string|max:255',
                    'goal' => 'nullable|string',
                    'goal_amount' => 'nullable|numeric|min:0',
                    'identifier' => 'required|string|max:20|unique:contribution_types,identifier',
                ];
                break;

            case 'PUT':
            case 'PATCH':
                $rules = [
                    'name' => 'sometimes|required|string|max:255',
                    'goal' => 'sometimes|nullable|string',
                    'goal_amount' => 'sometimes|nullable|numeric|min:0',
                    'identifier' => 'sometimes|required|string|max:20|unique:contribution_types,identifier,' . $route,
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
            'name.required' => 'Jina la aina ya mchango ni lazima.',
            'name.string' => 'Jina la aina ya mchango lazima liwe maandishi.',
            'name.max' => 'Jina la aina ya mchango lisiwe zaidi ya herufi 255.',
            'goal.string' => 'Malengo lazima yawe maandishi.',
            'goal_amount.numeric' => 'Kiasi cha malengo lazima kiwe namba.',
            'goal_amount.min' => 'Kiasi cha malengo lazima kiwe si chini ya sifuri.',
            'identifier.required' => 'Kitambulisho ni lazima.',
            'identifier.string' => 'Kitambulisho lazima kiwe maandishi.',
            'identifier.max' => 'Kitambulisho lisiwe zaidi ya herufi 20.',
            'identifier.unique' => 'Kitambulisho hiki kimeshatumika.',
        ];
    }
}
