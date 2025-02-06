<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProdutoStoreFormRequest extends FormRequest
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
            'nome' => 'required|max:255',
            'codigo' => 'required|unique:produtos,codigo',
            'preco' => 'required',
            'quantidade_estoque' => 'required'
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
            'nome.required' => 'O campo nome é obrigatório',
            'nome.max' => 'O máximo de caracteres do campo nome é 255',
            'codigo.required' => 'O campo codigo é obrigatório',
            'codigo.unique' => 'O campo código é único',
            'preco.required' => 'O campo preco é obrigatório',
            'quantidade_estoque.required' => 'O campo quantidade_estoque é obrigatório'
        ];
    }
}
