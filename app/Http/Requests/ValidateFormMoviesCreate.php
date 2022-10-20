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
            'classification_id' => 'required',
            'tag_id' => 'required',
            'image' => 'required',
            'duration' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name' => 'O titulo é obrigatório.',
            'description' => 'A descrição é obrigatória.',
            'tag_id' => 'O gênero é obrigatório',
            'classification_id' => 'A classificação é obrigatória.',
            'image' => 'A imagem é obrigatória.',
            'duration' => 'Tempo de duração é obrigatório',
        ];
    }
}
