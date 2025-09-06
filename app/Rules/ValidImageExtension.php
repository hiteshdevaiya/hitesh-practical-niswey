<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidImageExtension implements ValidationRule
{
    protected array $allowedExtensions;

    public function __construct()
    {
        $this->allowedExtensions = explode(',', config('media-library.allowed_extensions'));
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$value || !$value->isValid()) {
            return;
        }

        $extension = strtolower($value->getClientOriginalExtension());

        if (!in_array($extension, $this->allowedExtensions)) {
            $fail("The :attribute must be a file of type: " . strtoupper(implode(', ', $this->allowedExtensions)) . '.');
        }
    }
}
