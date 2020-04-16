<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PedidosFormRequest extends FormRequest
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
        return [
            'valor' => 'required'
        ]; 
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório'
            //'nome.min' => 'O campo nome precisa ter pelo menos 2 caracteres'
        ];
    }
}
