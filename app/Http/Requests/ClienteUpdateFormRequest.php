<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ClienteUpdateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'max:255',
                'email' => 'max:80',
                'telefone' => 'max:15',
                'endereco' => 'max:255'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            Response()->json([
                'status' => false,
                'message' => "Erro de validação",
                'erros' => $validator->Errors()
            ], 422));
    }

    public function messages(){
        return [
            'nome.max' => 'O máximo de caracteres do campo nome é 255',
            'email.max' => 'O máximo de caracteres do campo email é 80',
            'telefone.max' => 'O máximo de caracteres do campo telefone é 15',
            'endereco.max' => 'O máximo de caracteres do campo endereco é 255'
        ];
    }
}
