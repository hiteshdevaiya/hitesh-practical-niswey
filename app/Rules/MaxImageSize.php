<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MaxImageSize implements ValidationRule
{
    protected int $maxKilobytes;

    public function __construct(?int $maxKilobytes = null)
    {
        $this->maxKilobytes = $maxKilobytes ?? (config('media-library.max_file_size') / 1024);
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$value || !$value->isValid()) {
            return;
        }

        if ($value->getSize() > ($this->maxKilobytes * 1024)) {
            $fail("Maximum file size for :attribute is " . number_format($this->maxKilobytes / 1024, 2) . " MB.");
        }
    }
}
