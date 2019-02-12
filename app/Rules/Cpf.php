<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Cpf implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->validaCpf($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'CPF inválido.';
    }

    private function validaCpf($cpf)
    {
        if (empty($cpf)) {
            return false;
        }
        $cpf = str_replace(['.', '-', '_', ' '], ['', '', '', ''], $cpf);
        $cpf = preg_replace('[^0-9]', '', $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

        if (strlen($cpf) != 11) {
            return false;
        }

        if ($cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' ||
            $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' ||
            $cpf == '88888888888' || $cpf == '99999999999') {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
        }

        return true;
    }
}