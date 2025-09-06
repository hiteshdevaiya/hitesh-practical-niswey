<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class StrictEmail implements Rule
{
    public function passes($attribute, $value)
    {
        // Basic email format validation
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        // Strict validation - require @ and proper domain structure
        return (bool) preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $value);
    }

    public function message()
    {
        return 'Please enter a valid :attribute.';
    }
}
