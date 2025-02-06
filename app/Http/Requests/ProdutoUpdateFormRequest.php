<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProdutoUpdateFormRequest extends FormRequest
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
            'codigo' => 'unique:produtos,codigo',
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
            'codigo.unique' => 'O campo código é único',
        ];
    }
}
