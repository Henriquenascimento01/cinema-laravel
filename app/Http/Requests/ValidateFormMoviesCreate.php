<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateFormMoviesCreate extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [

            'name' => 'required',
            'description' => 'required',
            'tag' => 'required',
            'classification' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name' => 'O titulo é obrigatório.',
            'description' => 'A descrição é obrigatória.',
            'tag' => 'O gênero é obrigatório',
            'classification' => 'A classificação é obrigatória.'

        ];
    }
}
