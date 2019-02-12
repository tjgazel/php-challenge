<?php

namespace App\Http\Requests\Api;

use App\Rules\CartaoCredito;
use Illuminate\Foundation\Http\FormRequest;

class Pagamento extends FormRequest
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
            'cliente_id' => 'required',
            'plano_id' => 'required',
            'numero_cartao' => new CartaoCredito,
            'ccv' => 'required',
            'mes' => 'required',
            'ano' => 'required'
        ];
    }
}
