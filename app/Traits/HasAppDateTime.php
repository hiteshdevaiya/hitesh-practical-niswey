<?php

namespace App\Traits;

use DateTimeInterface;

trait HasAppDateTime
{
    /**
     * Prepare a date for array / JSON serialization.
     *
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format(config('constant.datetime_format'));
    }
}
