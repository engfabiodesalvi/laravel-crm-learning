<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUsuarioRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome'  => 'required|string|min:2|max:255',
            'senha' => 'required|string|min:6|max:255', // max adicionado por segurança
            'email' => [
                'required',
                'email:rfc,dns', // Validação RFC e DNS ativada
                'unique:usuarios,email'
            ],
        ];
    }

    /**
     * Customiza as mensagens de erro para esta validação.
     */
    public function messages(): array
    {
        // return [
        //     'email.unique'   => 'Este e-mail já está cadastrado em nosso sistema.',
        //     'email.required' => 'O campo e-mail é obrigatório.',
        //     'email.email'    => 'Por favor, insira um endereço de e-mail válido.',
        //     'nome.required'  => 'O campo nome é obrigatório.',
        //     'senha.min'      => 'A senha deve conter no mínimo 6 caracteres.',
        // ];

        return [
                // Validações do Nome
                'nome.required' => 'O campo nome é obrigatório.',
                'nome.string'   => 'O nome deve ser um texto válido.',
                'nome.min'      => 'O nome deve conter pelo menos 2 caracteres.',
                'nome.max'      => 'O nome não pode ter mais de 255 caracteres.',

                // Validações da Senha
                'senha.required' => 'O campo senha é obrigatório.',
                'senha.string'   => 'A senha deve ser um texto válido.',
                'senha.min'      => 'A senha deve conter pelo menos 6 caracteres.',
                'senha.max'      => 'Por motivos de segurança, a senha não pode ter mais de 255 caracteres.',

                // Validações do E-mail
                'email.required' => 'O campo e-mail é obrigatório.',
                'email.email'    => 'O e-mail informado não possui um formato válido ou o provedor de internet (DNS) não foi localizado.',
                'email.unique'   => 'Este endereço de e-mail já está cadastrado em nosso sistema.',
            ];        
    }    
}
