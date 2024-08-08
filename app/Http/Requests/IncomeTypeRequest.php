<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IncomeTypeRequest extends FormRequest
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
        $route = $this->route('type');

        switch ($this->getMethod()) {
            case 'POST':
                $rules = [
                    'name' => 'required|string|max:255',
                    'description' => 'nullable|string',
                    'identifier' => 'required|string|max:20|unique:income_type,identifier',
                ];
                break;

            case 'PUT':
            case 'PATCH':
                $rules = [
                    'name' => 'sometimes|required|string|max:255',
                    'description' => 'sometimes|nullable|string',
                    'identifier' => 'sometimes|required|string|max:20|unique:income_type,identifier,' . $route,
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
            'name.required' => 'Jina la aina ya kipato ni lazima.',
            'name.string' => 'Jina la aina ya kipato lazima liwe maandishi.',
            'name.max' => 'Jina la aina ya kipato lisiwe zaidi ya herufi 255.',
            'description.string' => 'Maelezo lazima yawe maandishi.',
            'identifier.required' => 'Kitambulisho ni lazima.',
            'identifier.string' => 'Kitambulisho lazima kiwe maandishi.',
            'identifier.max' => 'Kitambulisho lisiwe zaidi ya herufi 20.',
            'identifier.unique' => 'Kitambulisho hiki kimeshatumika.',
        ];
    }
}
