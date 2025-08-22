<?php

namespace App\Enums;

enum TaskFrequency: string
{
    case weekly = 'WEEKLY';
    case monthly = 'MONTHLY';
    case daily = 'DAILY';

    public function view()
    {
        return match ($this) {
            self::weekly => 'components.weekly',
            self::monthly => 'components.monthly',
            self::daily => 'components.daily'
        };
    }
}
