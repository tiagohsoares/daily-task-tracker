<?php

namespace App\Enums;

enum TaskFrequency: string
{
    case weekly = 'weekly';
    case monthly = 'monthly';

    public function view(){
        return match ($this) {
            self::weekly => 'components.weekly',
            self::monthly => 'components.monthly',
        };
    }
}
