<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NormalizeSpaces implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // No validation failure - just passes through after cleaning
    }

    public function passes($attribute, $value)
    {
        return true;
    }

    public static function sanitize($value): string
    {
        return trim(preg_replace('/\s+/', ' ', $value));
    }
}
