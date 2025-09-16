<?php

namespace App\Enums;

enum TaskFrequency: string
{
    case weekly  = 'WEEKLY';
    case monthly = 'MONTHLY';
    case daily   = 'DAILY';

    public function view(): string
    {
        return match ($this) {
            TaskFrequency::weekly  => 'components.weekly',
            TaskFrequency::monthly => 'components.monthly',
            TaskFrequency::daily   => 'components.daily'
        };
    }
}
