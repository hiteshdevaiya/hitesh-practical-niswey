<?php

namespace App\Enums;

enum Status: string
{
    case INACTIVE = '0';
    case ACTIVE = '1';

    public function label()
    {
        return match ($this) {
            static::INACTIVE => __('messages.common.inactive'),
            static::ACTIVE => __('messages.common.active')
        };
    }

    public function badgeClass()
    {
        return match ($this) {
            self::INACTIVE => 'bg-[#EC1A1A] text-white',
            self::ACTIVE => 'bg-[#06BA66] text-white',
            default => '',
        };
    }
}
