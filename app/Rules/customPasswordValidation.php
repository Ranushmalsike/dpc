<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;


class customPasswordValidation implements Rule
{
protected $pass;

    public function __construct($pass)
    {
        $this->pass = $pass;
    }
/**
 *Check the condition of Insert password
 */
    public function passes($attribute, $value)
    {
        return preg_match('/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*#?&]).{8,}$/', $this->pass);
    }
/**
 * Result message
 */
    public function message()
    {
        return 'The :attribute must be at least 8 characters long and contain at least one letter, one digit, and one special character.';
    }

}
