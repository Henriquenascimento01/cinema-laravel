<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormEditMovies extends FormRequest
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
            //'image' => 'required|bail|image|mimes:jpeg,png,jpg|max:4096'
        ];
    }

    public function messages()
    {
        return [
            'name' => 'O titulo é obrigatório.',
            'description' => 'A descrição é obrigatória.',
            'tag_id' => 'O gênero é obrigatório',
            'classification_id' => 'A classificação é obrigatória.',
            //'image' => 'A imagem é obrigatória.',
        ];
    }
}
