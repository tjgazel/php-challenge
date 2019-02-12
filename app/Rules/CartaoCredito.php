<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CartaoCredito implements Rule
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
     * @throws \Exception
     */
    public function passes($attribute, $value)
    {
        $value = str_replace(' ', '', $value);

        switch ($value) {
            case '1010101010101010':
                return true;
            case '2020202020202020':
                return false;
            case '3030303030303030':
                return (bool)random_int(0, 1);
            default:
                return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Número de cartão inválido';
    }
}
