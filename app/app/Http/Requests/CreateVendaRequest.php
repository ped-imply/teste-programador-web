<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateVendaRequest extends FormRequest
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
            'data' => ['nullable'],
            'cep' => ['required'],
            'uf' => ['required'],
            'cidade' => ['required'],
            'bairro' => ['required'],
            'endereco' => ['required'],
            'numero' => ['required'],
            'complemento' => ['nullable'],
            'itens.*.produto_id' => ['required'],
            'itens.*.valor' => ['required'],
        ];
    }
}
