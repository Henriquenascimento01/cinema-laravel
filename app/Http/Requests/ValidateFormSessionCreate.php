<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateFormSessionCreate extends FormRequest
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
            'date' => 'required',
            'time_initial' => 'required',
            'time_finish' => 'required',
            'room_id' => 'required',
            'movie_id' => 'required'

        ];
    }

    public function messages()
    {
        return [

            'date' => 'Campo data é obrigatório',
            'time_initial' => 'Horário de inicio é obrigatório',
            'time_finish' => 'Horário de termino é obrigatório',
            'room_id' => 'A sala de transmissão é obrigatória',
            'movie_id' => 'O filme é obrigatório'

        ];
    }
}
