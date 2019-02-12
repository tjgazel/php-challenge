<?php

namespace App\Http\Requests;

use App\Rules\Contatos;
use App\Rules\Cpf;
use Illuminate\Foundation\Http\FormRequest;

class Inscricao extends FormRequest
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
            'nome' => 'required',
            'cpf' => new Cpf,
            'email' => 'email',
            'contatos' => new Contatos,
            'cep' => 'required|size:9',
            'logradouro' => 'required|min:5|max:255',
            'numero' => 'required|max:10',
            'complemento' => 'max:20',
            'bairro' => 'required|max:255',
            'cidade' => 'required|max:255',
            'uf' => 'required|size:2',
            'plano_id' => 'required',
            'titular' => 'required|max:255',
            'numero_cartao' => 'required|size:19',
            'ccv' => 'required|size:3',
            'mes' => 'required|min:1|max:2',
            'ano' => 'required|size:4'
        ];
    }
}
